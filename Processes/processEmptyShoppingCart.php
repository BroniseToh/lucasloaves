<?php
session_start();

if(isset($_POST['EMPTY_CART']))
{
  unset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']);
  unset($_SESSION['ALL_ITEMS_BOUGHT']);
  $_SESSION['GRAND_TOTAL']=0;
  $_SESSION['ITEM_COUNTER'] = 0;
  $_SESSION['ARRAY_ORDERS'] = [];
}//if(isset($_POST['EMPTY_CART']))

header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>
