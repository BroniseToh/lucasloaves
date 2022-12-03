<?php

include("processConnectDB.php");

$productList = array();

$sql = "SELECT ProductNumber, ProductName, UnitPrice, ProductImage FROM product";

if($resultSet = mysqli_query($conn, $sql))
{
    while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    {
      array_push($productList, $record);
    }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
}

echo json_encode($productList);

?>