<?php
  $pageContent = "contentPages/contentJobDetails.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Job Details");

  window.addEventListener("load", function(){
    const thisHiddenPostNumberTextbox = document.querySelector("#hiddenPostNumber");
    const thisJobName = document.querySelector(".jobName");
    const thisJobDescription = document.querySelector(".jobDescription");
    const postNumberFromURL = getPostNumberFromURL(location.search);
    const  serverFileSendJobDetails = "Processes/job.php?postNumber=".concat(postNumberFromURL);
    
    ajaxGetDataFromServer(serverFileSendJobDetails, function(parJobDetails){
      thisHiddenPostNumberTextbox.value = postNumberFromURL;
      thisJobName.textContent = parJobDetails.JobName;
      thisJobDescription.textContent = parJobDetails.JobDescription;
      
    });    
  });
</script>
