<?php
class OrderItem{
  public $productNumber
        ,$productName
        ,$unitPrice
        ,$totalAmount
        ,$quantityOrdered
        ,$pickUpDate
        ,$pickUpTime
        ,$image
        ;

  function __construct($productNumber
                      ,$productName
                      ,$unitPrice
                      ,$totalAmount
                      ,$quantityOrdered
                      ,$pickUpDate
                      ,$pickUpTime
                      ,$image
      )
  {
    $this->productNumber = $productNumber;
    $this->productName = $productName;
    $this->unitPrice = $unitPrice;
    $this->totalAmount = $totalAmount;
    $this->quantityOrdered = $quantityOrdered;
    $this->pickUpDate = $pickUpDate;
    $this->pickUpTime = $pickUpTime;
    $this->image = $image;
  }//function __construct

}//$orderItemclass OrderItem
 ?>
