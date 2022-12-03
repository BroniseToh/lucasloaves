<?php
  $pageContent = "contentPages/contentBreadMakingClass.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Bread Making Class");
  const thisSection = document.querySelector(".breadMakingClassPromo");

  let  imageContainer  = createContainerImage("images/breadMakingClass.jpg")
      ,textContainer = createContainerText({
                     h3:"Bread Making Class"
                    ,ul:["Learn to make your own bread $350 plus GST."
                        ,"First Saturday of every month"
                        ,"9 am to 5pm with lunch provided"]
                    ,input:{type:"submit"
                           ,class:"btn btn-primary col-3 my-2"
                           ,role:"button"
                           ,value:"JOIN NOW!"
                           ,name:"JOIN_CLASS"}
                   });
  container = createContainerWithTwoColumns(imageContainer, textContainer);
  thisSection.appendChild(container);
</script>
