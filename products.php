<!-- <?php
  $pageContent = "contentPages/contentProducts.php";
  // include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Products");
  
</script> -->
<?php
  $pageContent = "contentPages/contentProducts.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Products");
  let thisRow="";
  let productDetails = "";

  const thisCardContainer = document.querySelector("#cardContainer");
        const serverFileGetProducts = "Processes/getProducts.php";

        ajaxGetDataFromServer(serverFileGetProducts, function(parArrayProducts){



          for(product of parArrayProducts)
          {
            //debugger;
            thisCardContainer.appendChild(createCard({productNumber: product.ProductNumber
                                                    , productName: product.ProductName
                                                    , price: product.UnitPrice
                                                    , image: product.ProductImage}));
          }
        });
</script>
