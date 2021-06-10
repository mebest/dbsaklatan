<div data-role="dialog" id="addCatalog" class="padding20"  data-close-button="true" data-overlay="true" data-background="bg-darkBlue">
       <div id="wrapper-chat">
    <div id="menu">
        <p class="welcome">Let's Talk!&nbsp;
        <div id="name"><?=$user_log['name'];?></div>
        </br>
        
        </p>
         <form name="message" action="">
        <div style="clear:both">
        </br>
        </div>
    </div>
    <div id="chatbox"></div>
</div>
     
   
        <textarea name="usermsg" type="text" id="usermsg" style="font-size: 14px;font-style: italic;" size="32" placeholder="Input message here.."></textarea>&nbsp;
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
<div class="portal"></span><a href="https://dbsmanila.online" target="_blank"><img src="../uploads/portal.png"></img></a></div>
<div class="chat"><?=$newstdchat?></span><img src="../uploads/virtual-assist.png" id="chatImage" onclick="metroDialog.toggle('#addCatalog')"></img></div>


<?php

?>

       <!-- Start: Footer -->

        <!-- End: Footer -->
        
        <!-- jQuery Latest Version 1.x -->

        </body>
        <script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change image every 2 seconds
}
</script>
        <script src='<?php echo base_url(); ?>js/sweetalert.min.js' type="text/javascript"></script>
        <script src="<?php echo base_url('js/student.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('js/getEmail.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
        


</html>
