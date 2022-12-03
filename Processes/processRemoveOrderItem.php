<?php
include_once "../Processes/OrderItem.php";
include_once "../Processes/lucasLoavesFunctions.php";
session_start();

foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)
{
  if($orderItem->productNumber==$_REQUEST["productNumber"])
  {
    $key=array_search($orderItem, $_SESSION['ARRAY_ORDERS']);
    unset($_SESSION['ARRAY_ORDERS'][$key]);    
  }
}//foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)

//Display "Your cart is empty" if all items in array have been removed
if(count($_SESSION['ARRAY_ORDERS'])==0){
  unset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']);
  unset($_SESSION['ALL_ITEMS_BOUGHT']);
  $_SESSION['GRAND_TOTAL']=0;
  $_SESSION['ITEM_COUNTER'] = 0;
  $_SESSION['ARRAY_ORDERS'] = [];

  echo "EMPTYCART";
}

 ?>
