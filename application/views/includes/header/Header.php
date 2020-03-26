<!DOCTYPE html>
<html lang="en">
<head>
	<title>
        <?php
        if(!empty($title)){
            echo $title;
        }
        ?>
    </title>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Morris Charts CSS -->
    <link href="<?=base_url('assets/app');?>/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="<?//=base_url('assets/app');?>/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<link href="<?=base_url('assets/app');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	
	<!-- bootstrap-select CSS -->
	<link href="<?=base_url('assets/app');?>/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
	
    <?php /*{ ?>
	<!-- Bootstrap Switches CSS -->
	<link href="<?//=base_url('assets/app');?>/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
		
	<!-- switchery CSS -->
	<link href="<?//=base_url('assets/app');?>/vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
	<?php }*/ ?>
    
	<!-- Custom CSS -->
	<link href="<?=base_url('assets/app');?>/dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>