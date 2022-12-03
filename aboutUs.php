<?php
  $pageContent = "contentPages/contentAboutUs.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("About Us");
  const thisMainSection = document.querySelector("main");

  //About Luca's Loaves
  let imageContainer  = createContainerImage("images/aboutUs/breadByHand.jpg")
      ,textContainer = createContainerText({
                     h3:"About Luca's Loaves"
                    ,p:"We make real bread from the best organic ingredients - by hand, with dedication and with the best of care."
                   })
      ,container = createContainerWithTwoColumns(imageContainer,textContainer);
  thisMainSection.appendChild(container);

  //Why Choose Luca's Loaves?
  imageContainer  = createContainerImage("images/aboutUs/aboutLuca.jpg");
  textContainer = createContainerText({
                   h3:"Why Choose Luca's Loaves"
                  ,ul:["No Store/Commercial yeast"
                      ,"Hand kneaded and shaped in-house"
                      ,"Prepared over 14 - 17 hours"
                      ,"Organic flour"
                      ,"Easy to digest"]
                 });
  container = createContainerWithTwoColumns(textContainer, imageContainer);
  thisMainSection.appendChild(container);

  //About Luca
  imageContainer  = createContainerImage("images/aboutUs/lifeguard.png");
  textContainer = createContainerText({
                     h3:"About Luca"
                    ,p:"Luca commenced his career as a lifeguard but was laid off. He found he enjoyed making bread and experimented and in no time at all had built up a thriving business."
                  });
  container = createContainerWithTwoColumns(imageContainer,textContainer);
  thisMainSection.appendChild(container);
</script>
