<?php
  $pageContent = "contentPages/contentOrderSummary.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Order Summary");
  const fileProcessOrderSummary = "Processes/sendOrders.php";
  const tableBody = document.querySelector("tbody");
  const grandTotalRow = document.querySelector(".grandTotalRow");
  let tableRow = ""; //this represents each row in order summary table.
  window.addEventListener("load", function(){    
    ajaxGetDataFromServer(fileProcessOrderSummary, function(parDataFromServer){
        salesOrderInfo = parDataFromServer.salesOrderInfo;
        itemsOrdered = parDataFromServer.itemsOrdered;        

        document.querySelector("#orderNumber").textContent = salesOrderInfo.OrderNumber;
        document.querySelector("#customerName").textContent = salesOrderInfo.CustomerName;
        document.querySelector("#orderDateAndTime").textContent = formatDateTimeOrderSummary(salesOrderInfo.OrderDate);
        document.querySelector("#grandTotal").textContent = formatAUD(salesOrderInfo.PaymentAmount);    

        for(item of itemsOrdered)
        {
          tableRow = createTableRow(item.ProductName
                                   ,item.UnitPrice
                                   ,item.QuantityOrdered
                                   ,item.TotalAmount
                                   ,formatDateDDMMMMYYYY(item.PickUpDate) //Pick-up date
                                   ,formatTimeHHMM(item.PickUpDate) //Pick-up time
                      );//createTableRow(item.ProductName
          tableBody.insertBefore(tableRow, grandTotalRow);
        }//for(item of itemsOrdered)

        if(itemsOrdered !== null)
        {
          //make the badge disappear
          document.querySelector(".badge").classList.remove("d-inline");
          document.querySelector(".badge").classList.add("d-none");
        }

    });
  });//window.addEventListener("load", function(){
</script>