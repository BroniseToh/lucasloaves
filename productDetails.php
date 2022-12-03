<?php
$pageContent = "contentPages/contentProductDetails.php";
include("templates/template.php");
?>

<script type="text/javascript">
<?php
 echo "setPageTitle('".$_SESSION['PRODUCT_NAME']."');";
?>
let dateToday = new Date();
const quantityToOrder = document.querySelector("#tbQuantity")
      ,dateTodayDateOnly = convertDateToYYYYMMDD(dateToday)
      ,pickUpDate = document.querySelector("#tbPickUpDate")
      ,pickUpTime = document.querySelector("#tbPickUpTime")
      ,priceDisplayed = document.querySelector(".price")
      ,unitPrice = document.querySelector("#unitPrice").value;

quantityToOrder.addEventListener("change", function(){
  priceDisplayed.textContent = formatAUD(unitPrice * this.value);
});

//Set the pick up date minimum value starting today
pickUpDate.setAttribute("value", dateTodayDateOnly);
pickUpDate.setAttribute("min", dateTodayDateOnly);

//Set the pick up time at least one hour from today.
let timeTodayAfterOneHour = new Date(dateToday.setHours(dateToday.getHours() + 1));
timeTodayAfterOneHourTimeOnly = convertTimeToHHSS12HOUR(timeTodayAfterOneHour);

//if pick-up date is current date then minimum time today is one hour after current time
if(pickUpDate.value===dateTodayDateOnly){
  pickUpTime.value = timeTodayAfterOneHourTimeOnly;
  pickUpTime.min = timeTodayAfterOneHourTimeOnly;
}

//if date is changed to current date, set minimum time to one hour after current time
pickUpDate.addEventListener("change", function(){
  pickUpTime.min = (this.value===dateTodayDateOnly)?timeTodayAfterOneHourTimeOnly:"07:00";
});
</script>
