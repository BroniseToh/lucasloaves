<?php
session_start();
include("processConnectDB.php");
include("lucasLoavesFunctions.php");

$arrayItemsOrdered = [];


$sql = "SELECT OrderNumber"
.", CONCAT(CustomerFirstname,' ', CustomerLastname) AS CustomerName"
.", OrderDate"
.", PaymentAmount"
." FROM SALESORDER"
." WHERE OrderNumber = ".$_SESSION['ORDER_NUMBER'];

$resultSet = mysqli_query($conn, $sql);


if($assocArraySalesOrderInfo = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
    //Get all items bought from $_SESSION['ORDER_NUMBER']
    $sql = "SELECT pro.ProductName"
     .", pro.UnitPrice"
     .", ord.QuantityOrdered"
     .", ord.TotalAmount"
     .", ord.PickUpDate"
     ." FROM SALESORDER AS sal"
     ." INNER JOIN ORDERLINE AS ord"
     ." ON sal.OrderNumber = ord.OrderNumber"
     ." INNER JOIN PRODUCT AS pro"
     ." ON ord.ProductNumber = pro.ProductNumber"
     ." WHERE sal.OrderNumber = ".$_SESSION['ORDER_NUMBER'];

     $resultSet = mysqli_query($conn, $sql);

     while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
     {
        array_push($arrayItemsOrdered, $record);
     }
     $arrayOrderDetails = array("salesOrderInfo"=>$assocArraySalesOrderInfo, "itemsOrdered"=>$arrayItemsOrdered);
}//if($assocArraySalesOrderInfo = mysqli_fetch_array($resultSet, MYSQLI_ASSOC)){
//unset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']);
unset($_SESSION['ALL_ITEMS_BOUGHT']);
$_SESSION['GRAND_TOTAL']=0;
$_SESSION['ITEM_COUNTER'] = 0;
$_SESSION['ARRAY_ORDERS'] = [];
$_SESSION['NUMBER_OF_ITEMS_BOUGHT'] = 0;
echo json_encode($arrayOrderDetails);                            
?>