<?php
function addItemsToOrder($parDBConnection)
{
  if(isset($_POST['JOIN_CLASS'])){
    $sql = "SELECT ProductNumber, ProductName, UnitPrice, ProductImage "
          . "FROM Product "
          . "WHERE ProductNumber = 5";
  
    $resultSet = mysqli_query($parDBConnection, $sql);
  
    while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    {
      $_SESSION['PRODUCT_NUMBER'] = $record['ProductNumber'];
      $_SESSION['PRODUCT_IMAGE'] = $record['ProductImage'];
      $_SESSION['PRODUCT_NAME'] = $record['ProductName'];
      $_SESSION['UNIT_PRICE'] = $record['UnitPrice'];
    }
  
    // $_SESSION['QUANTITY_ORDERED'] = 1;
    $_SESSION['PICKUP_DATE'] = date("Y-m-d", strtotime("first saturday of next month"));
    $_SESSION['PICKUP_TIME'] = "09:00";
    //$_SESSION['TOTAL_AMOUNT'] = $_SESSION['UNIT_PRICE'] * $_SESSION['QUANTITY_ORDERED'];
    $_SESSION['TOTAL_AMOUNT'] = $_SESSION['UNIT_PRICE'];
  }//if(isset($_POST['JOIN_CLASS'])){
  
  if(isset($_POST['SHOPPINGCART'])){
    $_SESSION['QUANTITY_ORDERED'] = $_POST['tbQuantity'];
    $_SESSION['PICKUP_DATE'] = $_POST['tbPickUpDate'];
    $_SESSION['PICKUP_TIME'] = $_POST['tbPickUpTime'];
    $_SESSION['TOTAL_AMOUNT'] = $_SESSION['UNIT_PRICE'] * $_SESSION['QUANTITY_ORDERED'];
  }//if(isset($_POST['SHOPPINGCART'])){
  
  $_SESSION['TOTAL_AMOUNT'] = $_SESSION['UNIT_PRICE'] * $_SESSION['QUANTITY_ORDERED'];
  
  $orderItem = new OrderItem($_SESSION['PRODUCT_NUMBER']
                            ,$_SESSION['PRODUCT_NAME']
                            ,$_SESSION['UNIT_PRICE']
                            ,$_SESSION['TOTAL_AMOUNT']
                            ,$_SESSION['QUANTITY_ORDERED']
                            ,$_SESSION['PICKUP_DATE']
                            ,$_SESSION['PICKUP_TIME']
                            ,$_SESSION['PRODUCT_IMAGE']
                            // ,$_SESSION['ITEM_COUNTER']
                          );
  
  array_push($_SESSION['ARRAY_ORDERS'], $orderItem);

}//function addItemsToOrder()

//This function must be called inside the script tag.
function createCard($productNumber, $productImage, $productName, $price)
{
  //below are echoes to javascript code.
  echo "productDetails = {productNumber:'$productNumber', productName:'$productName', price:'$price', image:'$productImage'};";
  echo "thisRow.appendChild(createCard(productDetails));";
}//function createCard($productNumber, $productImage, $productName, $price)

function generateSqlInsertIntoOrderline($parOrderNumber)
{
  $thisSQL = "INSERT INTO ORDERLINE(ProductNumber, OrderNumber, QuantityOrdered, PickUpDate, TotalAmount) VALUES ";
  foreach($_SESSION['ARRAY_ORDERS'] AS $orderItem){
    $thisSQL.="($orderItem->productNumber, $parOrderNumber, $orderItem->quantityOrdered, CONCAT('$orderItem->pickUpDate',' ','$orderItem->pickUpTime',':00'), $orderItem->totalAmount),";
  }

  return rtrim($thisSQL, ",");

}//function generateSqlInsertIntoOrderline()

/***********************************************************************
  * Function: getWorkingFolderURL()                                    *
  * Function Description:                                              *
  * outputs working folder URL. For example: if this file is in        *
  *   lucasLoaves/Processes folder, then the output will be:           *
  *   http://localhost/lucasLoaves/                          *
  *--------------------------------------------------------------------*
  * Parameter Description:                                             *
  * 1. parDifference. difference between original quantity and updated *
  *    quantity.                                                       *
  **********************************************************************/
  function getWorkingFolderURL()
  {
    $realDocRoot = realpath($_SERVER['DOCUMENT_ROOT']); //Applications/MAMP/htdocs
    $workingFolder = dirname(__DIR__);
    $prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $suffix = str_replace($realDocRoot, '', $workingFolder)."/"; ///lucasLoaves/Processes/
    $folderUrl = $prefix . $_SERVER['HTTP_HOST'] . $suffix;
    return $folderUrl;
  }//function getWorkingFolderURL()

/***********************************************************************
  * Function: getCurrentFolderURL()                                    *
  * Function Description:                                              *
  * outputs current folder URL. For example: if this file is in        *
  *   lucasLoaves/Processes folder, then the output will be:           *
  *   http://localhost/lucasLoaves/Processes/                           *
  *--------------------------------------------------------------------*
  * Parameter Description:                                             *
  * 1. parDifference. difference between original quantity and updated *
  *    quantity.                                                       *
  **********************************************************************/
function getCurrentFolderURL()
{
  $realDocRoot = realpath($_SERVER['DOCUMENT_ROOT']);
  $realDirPath = realpath(__DIR__);
  $prefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
  $suffix = str_replace($realDocRoot, '', $realDirPath)."/";
  $folderUrl = $prefix . $_SERVER['HTTP_HOST'] . $suffix;
  return $folderUrl;
}//function getCurrentFolderURL()

function getLastInsertID($parDBConnection)
{
  $sql = "SELECT LAST_INSERT_ID()";  

  if($resultSet = mysqli_query($parDBConnection, $sql)){
    while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
      $lastInsertID = $record['LAST_INSERT_ID()'];
    }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
  }//if($resultSet = mysqli_query($parDBConnection, $sql)){
  return $lastInsertID;
}//function getLastInsertID()

function emptyCart(){
  $_SESSION['ARRAY_ORDERS']=[];

  //Display "Your cart is empty" if all items in array have been removed
  if(count($_SESSION['ARRAY_ORDERS'])==0){
    unset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']);
    unset($_SESSION['ALL_ITEMS_BOUGHT']);
    unset($_SESSION['ORDER_NUMBER']);
    $_SESSION['GRAND_TOTAL']=0;
    $_SESSION['ITEM_COUNTER'] = 0;

  }
}//function emptyCart()


function recordOrderItem($parOrderItem){

  $_SESSION['ITEM_BOUGHT'] =  "thisColItemsContainer.appendChild(createShoppingCartItem({productNumber:$parOrderItem->productNumber";  
  $_SESSION['ITEM_BOUGHT'] .=  ",productName:'$parOrderItem->productName'";
  $_SESSION['ITEM_BOUGHT'] .=  ",unitPrice:$parOrderItem->unitPrice";
  $_SESSION['ITEM_BOUGHT'] .=  ",amount:$parOrderItem->totalAmount";
  $_SESSION['ITEM_BOUGHT'] .=  ",quantityOrdered: $parOrderItem->quantityOrdered";
  $_SESSION['ITEM_BOUGHT'] .=  ",pickUpDate:'$parOrderItem->pickUpDate'";
  $_SESSION['ITEM_BOUGHT'] .=  ",pickUpTime:'$parOrderItem->pickUpTime'";
  $_SESSION['ITEM_BOUGHT'] .=  ",image:'$parOrderItem->image'";
  $_SESSION['ITEM_BOUGHT'] .=  ",itemCounter: $parOrderItem->itemCounter}));";


  
  //record the grand total
  $_SESSION['ALL_ITEMS_BOUGHT'] .= $_SESSION['ITEM_BOUGHT'];
  $itemTotalAmount = $parOrderItem->quantityOrdered * $parOrderItem->unitPrice;  
  
  if(isset($_SESSION['GRAND_TOTAL']))
  { 
    $_SESSION['GRAND_TOTAL'] = $_SESSION['GRAND_TOTAL'] + $itemTotalAmount;    
  }
  else {
    $_SESSION['GRAND_TOTAL'] = $itemTotalAmount;    
  }
}//function recordOrderItem($arrayOrders)

function resetItemsBought(){
  $_SESSION['ALL_ITEMS_BOUGHT'] = "";
  $_SESSION['GRAND_TOTAL']=0;
}

/*****************************************************************************
 * Function: uploadImageFile($parThisFile, $parMemberID)                     *
 * Function Description:                                                     *
 * This function uploads the image file provided by the user to the server.  *
 * This function also renames the filename to member[x].jpg, where[x] is the *
 *    memberID. This is done so that the memberID is always unique.          *
 *---------------------------------------------------------------------------*
 * Parameter Description:                                                    *
 * 1. $parThisFile. the file uploaded by the user.                           *
 * 2. $parMemberID. memberID that forms part of the renamed file name.       *
 *    example: member1.jpg                                                   *
 *****************************************************************************/
function uploadFile($parThisFile)
{
    $userFolder = "../jobApplications/";
    $newFilename = $parThisFile['name'];
    $path_filename_ext = $userFolder.$newFilename;

    move_uploaded_file($parThisFile['tmp_name'], $path_filename_ext);

    return $newFilename;
}//function setMemberImageFilename($parOrigFilename)

?>
