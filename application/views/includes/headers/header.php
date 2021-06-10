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
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url('css/metro.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('css/metro-icons.css'); ?>" rel="stylesheet">
        <link href="<?=base_url('css/metro-responsive.css'); ?>" rel="stylesheet">
        <link href="<?=base_url('css/Emerfiry.css'); ?>" rel="stylesheet">
        <link href='<?php echo base_url(); ?>css/fullcalendar.min.css' rel='stylesheet' />
        <link href='<?php echo base_url(); ?>css/fullcalendar.print.css' rel='stylesheet' media='print' />
        <link href="<?php echo base_url(); ?>css/bootstrapValidator.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/bootstrap-colorpicker.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>css/bootstrap-timepicker.min.css" rel="stylesheet" />
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
    </head>
<body onload="startTime()">
    <div data-role="dialog" id="tech" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
        <form action="<?php echo site_url('ElibrarySystem/addStudent') ?>" method="post" enctype="multipart/form-data">
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
        </form>
    </div>
</div>
<div data-role="dialog" id="about" class="padding20" data-close-button="true" data-overlay="true" data-background="bg-darkBlue" data-overlay-click-close="true">
    <div class="grid padding20 fg-white">
        <form action="<?php echo site_url('ElibrarySystem/addStudent') ?>" method="post" enctype="multipart/form-data">
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
        </form>
    </div>
</div>
        <div class="app-bar fixed-top darcula" data-role="appbar">
            <a class="app-bar-element branding">E-Library</a>
            <span class="app-bar-divider"></span>
            <ul class="app-bar-menu">
                <li><a href="<?= base_url('ElibrarySystem/landing_page'); ?>" style="text-decoration: none;">Dashboard</a></li><span class="app-bar-divider"></span>
                    
                <li>
                    <a href="" class="dropdown-toggle" style="text-decoration: none;">Menu</a>
                    <ul class="d-menu" data-role="dropdown">
                        <?= $send['link'] ?>
                    </ul>
                </li><span class="app-bar-divider"></span>
                <li>
                    <a href="" class="dropdown-toggle" style="text-decoration: none;"><span class="mif-users fg-lightGreen"></span> Online Staff</a>
                    <ul class="d-menu" data-role="dropdown">
                        <?php
                        foreach ($online['user'] as $row) {
                            echo '<li><a><span class="mif-sun4 fg-lightOlive"></span>' . $row->username . '</a></li>';
                        }
                        ?>
                    </ul>
                </li><span class="app-bar-divider"></span>
                <li>
                    <a href="chatpage" style="text-decoration: none;"><span class="mif-bubbles fg-lightGreen"></span> Chat<?=$newchat?></a>
                </li><span class="app-bar-divider"></span>
                <li>
                    <a href="" class="dropdown-toggle" style="text-decoration: none;">Help</a>
                    <ul class="d-menu" data-role="dropdown">
                        <li><a onclick="metroDialog.toggle('#tech')">Tech support</a></li>
                        <li class="divider"></li>
                        <li><a onclick="metroDialog.toggle('#about')">About</a></li>
                    </ul>
                </li><span class="app-bar-divider"></span>
                <li>&emsp;<span id="time"></span>&emsp;</li>
            </ul>
            <div class="app-bar-element place-right">
                <span class="dropdown-toggle">Hi! <?= $user_log['name'] ?></span>
                <div class="app-bar-drop-container padding10 place-right no-margin-top block-shadow " data-role="dropdown" data-no-close="true" style="width: 220px">
                    <h3 class="text-light text-shadow fg-lighterBlue"><?= $stat['status']; ?></h3>
                    <ul class="unstyled-list fg-dark">
                        <li><a href="<?= base_url('ElibrarySystem/account_change?user_id='.$user_log['id'].''); ?>">Security</a></li>
                        <li><a href="<?= base_url('ElibrarySystem/Logout?user_id='.$user_log['id'].''); ?>">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="page-content">
            <div class="flex-grid" style="height: 100%;">
                <div class="row" style="height: 100%">
                    
