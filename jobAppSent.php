<?php
  $pageContent = "contentPages/contentJobApplicationSent.php";
  include("templates/template.php");
?>

<script>
    window.addEventListener("load", function(){
        const serverFileSendReferenceNumber = "Processes/sendReferenceNumber.php";

        ajaxGetDataFromServer(serverFileSendReferenceNumber, function(parReferenceNumber){
            document.querySelector(".referenceNumber").textContent = parReferenceNumber;
        });
    });
</script>