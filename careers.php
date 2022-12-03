<?php
  $pageContent = "contentPages/contentCareers.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Careers");
  const thisContainer = document.querySelector(".container");
  const parServerFileSendJobPost = "Processes/job.php";  
  window.addEventListener("load", function(){
    ajaxGetDataFromServer(parServerFileSendJobPost, function(parArrayJobPost){

      for(jobPost of parArrayJobPost){
        thisContainer.appendChild(createJobPost(jobPost.PostNumber
                                        , jobPost.JobName
                                        , jobPost.JobDescription
                                        , Number(jobPost.Salary)
                                        , jobPost.Negotiable
                                        , jobPost.JobStatus
                                        ));

      }

    });

  });

    


</script>