<?php
include("processConnectDB.php");
include("OrderItem.php");
include("lucasLoavesFunctions.php");
session_start();

$isItemAlreadyAddedToOrder = false;

if(isset($POST['JOIN_CLASS']))
{
  $_SESSION['PRODUCT_NUMBER'] = 5;
  $_SESSION['QUANTITY_ORDERED'] = 1;
} 
//BEGIN: Check if the item has been bought:
if(isset($_SESSION['ARRAY_ORDERS'])){
  foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)
  {
    if($orderItem->productNumber==$_SESSION["PRODUCT_NUMBER"])
    {
      //if the item has been bought, add the quantity only.
      $orderItem->quantityOrdered+=$_SESSION['QUANTITY_ORDERED'];
      $_SESSION['GRAND_TOTAL'] += $orderItem->totalAmount;
      $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] += $_SESSION['QUANTITY_ORDERED'];
      $isItemAlreadyAddedToOrder = true;
    }
  }//foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)

  if($isItemAlreadyAddedToOrder==false)
  {
    addItemsToOrder($conn);

    $_SESSION['GRAND_TOTAL'] += $_SESSION['TOTAL_AMOUNT'];

    if(isset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']))
    {
      $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] = $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] + $_SESSION['QUANTITY_ORDERED'];
      // $_SESSION['ITEM_COUNTER']++;
    }
    else {
      //first item to buy
      $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] = $_SESSION['QUANTITY_ORDERED'];
      // $_SESSION['ALL_ITEMS_BOUGHT'] = "";
      // $_SESSION['ITEM_COUNTER'] = 0;
    }

  }//if($isItemAlreadyAddedToOrder==false)


}//if (isset($_SESSION['ARRAY_ORDERS'])){
else
{
    $_SESSION['ARRAY_ORDERS'] = [];
}
//END: Check if the item exist:

// if(!isset($_SESSION['ARRAY_ORDERS'])){
//   $_SESSION['ARRAY_ORDERS'] = [];
//   echo "initialising array orders...";
// }

header("Location: ".getWorkingFolderURL()."shoppingCart.php"); 
exit();
 ?>
