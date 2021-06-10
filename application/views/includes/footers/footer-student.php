<div data-role="dialog" id="addCatalog" class="padding40" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
       <div id="wrapper">
    <div id="menu">
        <p class="welcome">Lets Talk!</br>
        <div id="name"><?=$user_log['name'];?></div>	
        </p>
         <form name="message" action="">
        <div style="clear:both">
        </br>
        </div>
    </div>
    <div id="chatbox"></div>
</div>
     
   
        <textarea name="usermsg" type="text" id="usermsg" style="font-size: 14px;" size="32"></textarea>&nbsp;
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>

<img src="../uploads/virtual-assist.png" class="chat" onclick="metroDialog.toggle('#addCatalog')"></img>

<?php

?>

       <!-- Start: Footer -->

        <!-- End: Footer -->
        
        <!-- jQuery Latest Version 1.x -->

        </body>

        <script src="<?php echo base_url('js/student.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
         
       

</html>
