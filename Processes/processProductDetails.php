<?php
session_start();
include("processConnectDB.php");
include("lucasLoavesFunctions.php");

if(isset($_POST['VIEWITEM']))
{
  //echo "product number is: ".$_POST['ProductNumber'];
  $productNumber = $_POST['ProductNumber'];

  $sqlRetrieveProductDetails = "SELECT ProductNumber
                                    , ProductName
                                    , ProductDescription
                                    , ProductImage
                                    , UnitPrice
                                 FROM PRODUCT
                                WHERE productNumber = $productNumber
                                    ";

  $resultSet = mysqli_query($conn, $sqlRetrieveProductDetails);

  while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
  {
    $_SESSION['PRODUCT_NUMBER'] = $record['ProductNumber'];
    $_SESSION['PRODUCT_IMAGE'] = $record['ProductImage'];
    $_SESSION['PRODUCT_NAME'] = $record['ProductName'];
    $_SESSION['UNIT_PRICE'] = $record['UnitPrice'];
    $_SESSION['PRODUCT_DESCRIPTION'] = $record['ProductDescription'];
  }

  header("Location: ".getWorkingFolderURL()."productDetails.php");
  exit;
}//if(isset($_POST['VIEWITEM']))
?>
