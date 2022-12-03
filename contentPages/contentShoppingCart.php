<h3 class="text-center">Shopping Cart</h3>

<div class="shoppingCart container mb-3">
  <form action="Processes/processCheckout.php" method="post">
    <div class="row">
      <div class="colItems col-12 col-md-8">
      </div>
      <div class="colCheckout col-12 col-md-4">
        <div class="totalOnTopOfCheckOut"></div>
        <form>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="firstName" placeholder="Enter first name">
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="lastName" placeholder="Enter last name">
          </div>
          <div class="form-group mb-3">
            <input type="email" class="form-control" name="customerEmail" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="contactPhone" placeholder="Enter contact phone">
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="creditCardNumber" placeholder="Enter credit card number">
          </div>
          <div class="container mb-3">
            <div class="row">
              <div class="col">
                <div class="form-group">
                    <label for="cc-exp" class="control-label mb-1">Expiration</label>
                    <input id="cc-exp" name="expiration" type="tel" class="form-control cc-exp"   placeholder="MM / YY" autocomplete="cc-exp">
                </div>
              </div>
              <div class="col">
                <label for="x_card_code" class="control-label mb-1">CVV</label>
                <input id="x_card_code" name="securityCode" type="tel" class="form-control cc-cvc"  autocomplete="off" >
              </div>
            </div>

          </div>
          <!-- <button id="generateTestData" class="btn btn-primary col-12 mb-3">Generate Test Data</button> -->
          <button type="submit"
                  class="btn btn-primary col-12 mb-3"
                  name="CHECKOUT">
                  CHECKOUT
          </button>

          <input type="button" value="GENERATE TEST DATA">
          
          
        </form>
      </div>
    </div><!-- <div class="row"> -->
  </form>
</div><!-- <div class="container"-->

<script>

  //BEGIN: Generate test data
  document.querySelector("input[type='button']").addEventListener("click", function(){
    //alert("Generating test data.");
    //console.log(document.querySelector("#firstName"));
    document.querySelector("input[name='firstName']").value = "John";
    document.querySelector("input[name='lastName']").value = "Doe";
    document.querySelector("input[name='customerEmail']").value = "johnDoe@email.com";
    document.querySelector("input[name='contactPhone']").value = "0412345678";
    document.querySelector("input[name='creditCardNumber']").value = "123";
    document.querySelector("input[name='expiration']").value = "08/26";
    document.querySelector("input[name='securityCode']").value = "123";
    
  });
</script>
