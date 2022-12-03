<?php
  $pageContent = "contentPages/contentShoppingCart.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Shopping Cart");
  const thisColItemsContainer = document.querySelector(".colItems");
  const thisColCheckoutTotal = document.querySelector(".totalOnTopOfCheckOut");
  const thisForm = document.querySelector("form");
  let thisShoppingCartContainer = document.querySelector(".shoppingCart");

  let thisCheckoutTotal = "";
  let thisColItemsTotal = "";

  window.addEventListener("load", function(){
      const serverFileGetArrayOrderItems = "Processes/sendArrayOrderItems.php";
      const serverFileGetGrandTotal = "Processes/sendGrandTotal.php";

      ajaxGetDataFromServer(serverFileGetArrayOrderItems, function(parArrayOrderItems){     
        if(parArrayOrderItems.length > 0)
        {
          for (orderItem of parArrayOrderItems)
          {
            thisColItemsContainer.appendChild(createShoppingCartItem({productNumber: orderItem.productNumber
                                                                     ,productName: orderItem.productName 
                                                                     ,unitPrice: orderItem.unitPrice
                                                                     ,amount: orderItem.totalAmount
                                                                     ,quantityOrdered: orderItem.quantityOrdered
                                                                     ,pickUpDate: orderItem.pickUpDate
                                                                     ,pickUpTime: orderItem.pickUpTime
                                                                     ,image: orderItem.image
                                                                     //,itemCounter: orderItem.itemCounter
            }));

          }//for (orderItem of parArrayOrderItems)

            let quantityBoxes = document.querySelectorAll('.shoppingCartQuantity');
            let quantityBox = '';
            let amountSection = '';
            let amount = 0;
            let unitPrice=0;
            let difference = 0;
            let updatedQuantity = 0;
            let productNumber = '';
            let origQuantityOrderedElement = '';

            let removeItemButtons = document.querySelectorAll('.removeButton');
            let removeItemButton = '';

            //BEGIN: PROCESS QUANTITY BUTTONS
            for(let index = 0; index < quantityBoxes.length; index++){
              quantityBox = quantityBoxes[index];              
              quantityBox.addEventListener('change', function(){
                //Change the total amount for each item depending on quantity
                updatedQuantity = this.value;
                productNumber = this.parentElement.nextSibling.parentElement.nextSibling.querySelector('.cartItemProductNumber').value;
                unitPrice = this.parentElement.nextSibling.parentElement.nextSibling.nextSibling.querySelector('.cartItemUnitPrice').value;
                amount = unitPrice * this.value;
                origQuantityOrderedElement = this.parentElement.nextSibling.parentElement.nextSibling.nextSibling.nextSibling.querySelector('.cartItemQuantityOrdered');
                difference = this.value - origQuantityOrderedElement.value;
                origQuantityOrderedElement.value = this.value;

                // Change the total of number of items in the shopping cart badge
                ajaxChangeQuantityAndGrandTotal(productNumber, updatedQuantity, difference, unitPrice, amount);
                amountSection = this.parentElement.previousSibling.querySelector('.amount');
                amountSection.textContent = '$'+amount;
              });
            }
            //END: PROCESS QUANTITY BUTTONS


            //Display total at the top of checkout
            ajaxGetDataFromServer(serverFileGetGrandTotal, function(parGetGrandTotal){
                thisCheckoutTotal = createElementWithTextNode('h4','Total: '+formatAUD(parGetGrandTotal));
                thisCheckoutTotal.setAttribute('class', 'text-center grandTotal');
                thisColCheckoutTotal.appendChild(thisCheckoutTotal);

                //Display total below the items list.
                thisColItemsTotal = thisCheckoutTotal.cloneNode(true);
                thisColItemsTotal.setAttribute('class', 'grandTotal text-end');
                thisColItemsContainer.appendChild(thisColItemsTotal);
            });
        }
        else
        {
          //FOR EMPTY CART
          displayMessageEmptyCart(thisForm, thisShoppingCartContainer);
        }

        //BEGIN: Remove item from cart
        const cartRemoveButtons = document.querySelectorAll(".removeButton");
        for(cartRemoveButton of cartRemoveButtons)
        {
            cartRemoveButton.addEventListener("click", function(){
              const thisCartItem = this.closest(".cartItem");
              const unitPrice = thisCartItem.querySelector('.cartItemUnitPrice').value;
              const quantityOrdered = thisCartItem.querySelector('.cartItemQuantityOrdered').value;
              const difference = 0 - quantityOrdered;
              const productNumber = thisCartItem.querySelector('.cartItemProductNumber').value;

              const amount = unitPrice * quantityOrdered;
              const cartBadge = document.querySelector('.badge');

              const serverFileChangeQuantityAndGrandTotal = 'Processes/processChangeInQuantityAndGrandTotal.php?productNumber='+productNumber
                                                                        +'&updatedQty='+quantityOrdered
                                                                              +'&diff='+difference
                                                                          +'&unitPrice='+unitPrice
                                                                          +'&amount='+amount;     
                                 
              ajaxGetDataFromServer(serverFileChangeQuantityAndGrandTotal, function(parServerResponse){ 
                const grandTotals = document.querySelectorAll(".grandTotal");
                if(parServerResponse["numItemsBought"] > 0)
                {
                  cartBadge.textContent= parServerResponse["numItemsBought"];
                  for(grandTotal of grandTotals)
                  {
                    grandTotal.textContent = "Total: "+formatAUD(parServerResponse["updatedGrandTotal"]);
                  }//for(grandTotal of grandTotals)
                }
                else
                {
                  cartBadge.classList.remove("d-inline");
                  cartBadge.classList.add("d-none");
                }
              });//ajaxGetDataFromServer(serverFileChangeQuantityAndGrandTotal, function(parServerResponse){

              ajaxRemoveThisCartItem(productNumber);
              thisCartItem.remove();

          });//cartRemoveButtons[index].addEventListener("click", function(){
        }//for(let index=0; index<cartRemoveButtons.length; index++)
        
        //END: Remove item from cart
        
      });//ajaxGetDataFromServer(serverFileGetArrayOrderItems, function(parArrayOrderItems){

    });//window.addEventListener("load", function(){
</script>