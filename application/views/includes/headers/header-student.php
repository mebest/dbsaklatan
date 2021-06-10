<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    

<head>        
        
        <!-- Meta -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1">
        
        <!-- Title -->
        <title>DBS - ELibrary</title>
        
        <!-- Favicon -->
        <link href="<?=base_url('images/favicon.ico');?>" rel="icon" type="image/x-icon" />
        <link href="<?php echo base_url('css/metro.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/metro-icons.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/metro-responsive.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/Emerfiry.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('css/jquery-ui.css'); ?>" type="text/css" rel="stylesheet" media="all" />
        <link href="<?php echo base_url('css/ui.theme.css'); ?>" type="text/css" rel="stylesheet" media="all" /> 
        <script src="<?php echo base_url('js/jquery-2.1.3.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('js/jquery.min.js'); ?>" type="text/javascript"></script>
          
        <script src="<?php echo base_url('js/jquery-ui.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('js/metro.js'); ?>" type="text/javascript"></script>  
        <link href="<?php echo base_url(); ?>css/sweetalert.min.css" rel="stylesheet" />
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            function startTime()
            {
                var d = new Date();
                var cd = d.toLocaleDateString();
                var ct = d.toLocaleTimeString();
                document.getElementById("time").innerHTML = cd + " - " + ct;
                setTimeout('startTime()', 1000);
            }
            
        </script>
        <style>
        * {box-sizing: border-box;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.textcs {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 50px;
  width: 100%;
  text-align: center;
}

.textcss {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 5px;
  width: 100%;
  text-align: center;
}

.textcsw {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  bottom: 30px;
  width: 100%;
  text-align: center;
}
/* Number text (1/3 etc) */
.numbertext {
  background-color: rgba(140, 140, 140, .6);
  color: #ffffff;
  font-size: 16px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 7px;
  width: 7px;
  margin: 0 2px;
  background-color: #6376d6;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 3.5s;
  animation-name: fade;
  animation-duration: 3.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
    </head>
<body onload="startTime()">
    <div data-role="dialog" id="tech" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
            <div class="row">
                <div class="cell">
                    <div class="content">
                                        <center><br><br>
                                            <p>Library System V1.0.0</p>
                                            <p>for technical concern. please send an e-mail to us @ <b>lrc.dbsmanila@gmail.com</b></p>
                                    </div>
                    
                </div>
                <div class="cell"></div>
            </div>
    </div>
</div>
    <div data-role="dialog" id="about" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
            <div class="row">
                <div class="cell">
                    <div class="content">
                                        <center><br><br>
                                            <p><b>Library System V1.0.0</b></p>
                                            <p>System integration for paperless process of request.</p>
                                            <p><b>Framework:</b> Codeigniter <b>Front-End:</b> Metro UI CSS</p>
                                            <p><b>Database:</b> phpMyAdmin</p>
                                            <br>
                                            <p>Programmed by: Bestil, Em P.</p>
                                            <p>Developed and Coded By: Systemize</p><br>
                                            <p>Don Bosco School (Salesian Sisters) Inc.</center>
                                        
                                    </div>
                    
                </div>
                <div class="cell"></div>
            </div>
    </div>
</div>
        <div class="app-bar fixed-top darcula" data-role="appbar">
            <a class="app-bar-element branding" style="text-decoration: none;"><img src="../uploads/logo.png" style="width: 30px; height: 30px; top: 5px;">&nbsp;E-Library</a>
            <span class="app-bar-divider"></span>
            <ul class="app-bar-menu">
                <li><a href="<?= base_url('ElibrarySystem/landing_page'); ?>">Dashboard</a></li><span class="app-bar-divider"></span>
                <li><a href="<?= base_url('ElibrarySystem/book_catalog'); ?>" style="text-decoration: none;">Book Catalog</a></li><span class="app-bar-divider"></span>
                <li>
                    <a href="" class="dropdown-toggle">Help</a>
                    <ul class="d-menu" data-role="dropdown">
                        <li><a onclick="metroDialog.toggle('#tech')">Tech support</a></li>
                        <li class="divider"></li>
                        <li><a onclick="metroDialog.toggle('#about')">About</a></li>
                    </ul>
                </li><span class="app-bar-divider"></span>
                <li><a href=""><span id="time"></span></a></li>
            </ul>

            <div class="app-bar-element place-right">
                <span class="dropdown-toggle">Hi! <?= $user_log['name'] ?></span>
                <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow " data-role="dropdown" data-no-close="true" style="width: 220px">
                    <h3 class="text-light text-shadow fg-lighterBlue"><?= $stat['status']; ?></h3>
                    <ul class="unstyled-list fg-dark">
                        <li><a href="<?= base_url('ElibrarySystem/my_books?user_id='.$user_log['name'].''); ?>">My Books</a></li>
                        <li><a href="<?= base_url('ElibrarySystem/updateEmail'); ?>">Profile</a></li>
                        <li><a href="<?= base_url('ElibrarySystem/account_change?user_id='.$user_log['id'].''); ?>">Security</a></li>
                        <li><a href="<?= base_url('ElibrarySystem/Logout?user_id='.$user_log['id'].''); ?>">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>

 
        <div class="page-content">
            <div class="flex-grid" style="height: 100%;">
                <div class="row" style="height: 100%">
                    
