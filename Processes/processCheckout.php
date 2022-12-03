<?php
include("processConnectDB.php");
include("OrderItem.php");
include("lucasLoavesFunctions.php");
session_start();

if(isset($_POST['CHECKOUT'])){
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $customerEmail = $_POST['customerEmail'];
  $contactPhone = $_POST['contactPhone'];
  $creditCardNumber = $_POST['creditCardNumber'];
  $expiration = $_POST['expiration'];
  $securityCode = $_POST['securityCode'];

  $sql = "INSERT INTO SALESORDER("
       . "OrderDate"
       . ",CustomerFirstname"
       . ",CustomerLastname"
       . ",CustomerEmail"
       . ",CustomerPhone"
       . ",CreditCardNumber"
       . ",CardExpiryDate"
       . ",SecurityCode"
       . ",PaymentAmount"
       . ")"
       . "VALUES("
       . "NOW(), '$firstName', '$lastName', '$customerEmail', '$contactPhone'"
       .", '$creditCardNumber', '$expiration', '$securityCode',"
       .$_SESSION['GRAND_TOTAL']
       . ")";

   if($resultSet = mysqli_query($conn, $sql)){
     $_SESSION['ORDER_NUMBER'] = mysqli_insert_id($conn);
     $orderNumber = $_SESSION['ORDER_NUMBER'];

     $sql = generateSqlInsertIntoOrderline($orderNumber);

     $resultSet = mysqli_query($conn, $sql);
  }//if($resultSet = mysqli_query($conn, $sql)){

    header("Location: ".getWorkingFolderURL()."orderSummary.php");
    exit();
}//if(isset($_POST['CHECKOUT'])){
 ?>
