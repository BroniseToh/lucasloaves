<div class="container my-2">
  <div class="row">
    <div class="productImage col-md-7 col-sm-12">
      <img class="img-fluid w-100" src="images/productImages/<?php echo $_SESSION['PRODUCT_IMAGE'];?>" alt="Unable to load image">
    </div><!-- <div class="productImage col-md-7 col-sm-12"> -->
    <div class="productDetails col-md-5 col-sm-12 mt-5">
      <form action="Processes/processShoppingCart.php" name="orderForm" method="post">
        <h3 class="itemName text-center"><?php echo $_SESSION['PRODUCT_NAME'];?></h3>
        <br>
        <h3 class="any price text-center">
          $<?php echo number_format((float)$_SESSION['UNIT_PRICE'], 2, '.', '');?>
        </h3>
        <div class="form-group row">
          <input class="d-none" type="text" name="unitPrice" id="unitPrice" value="<?php echo $_SESSION['UNIT_PRICE'];?>">
        </div>
        <div class="form-group row">
          <label for="tbQuantity">Quantity:</label>
          <div class="col-12">
            <input class="form-control" type="number" min="1" value="1" id="tbQuantity" name="tbQuantity">
          </div>
          </div>
          <div class="form-group my-5">
            <label for="pickUpDate">Pick-up date:</label>
            <div class="col-12">
              <input class="form-control" type="date" id="tbPickUpDate" name="tbPickUpDate">
            </div>
          </div>
          <div class="form-group my-5">
            <label for="pickUpTime">Pick-up time:</label>
            <div class="col-12">
              <input class="form-control" type="time" id="tbPickUpTime" name="tbPickUpTime" min="07:00" max="16:00" value="07:00">
            </div>
          </div>
          <input class="d-none" type="text" name="productNumber" value="<?php echo $_SESSION['PRODUCT_NUMBER']; ?>">
        <input type='submit'
               class='btn btn-primary col-12 mt-2'
               role='button'
               value='ADD TO SHOPPING CART'
               name='SHOPPINGCART'
               onclick="validateOrder();"
               >
      </form>
    </div><!-- <div class="productDetails col-md-5-col-sm-12"> -->
  </div><!-- <div class="row"> -->
  <div class="row my-5">
    <div class="productDescription col-12">
      <h4>Description</h4>
      <?php echo $_SESSION['PRODUCT_DESCRIPTION'];?>
    </div>
  </div>
  <!-- <div class="row"> -->
</div><!-- <div class="container"> -->
