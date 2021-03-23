<!DOCTYPE html>
<html lang="en">
<head>
	<title>pharmlinks |
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
	
	<?php
	/*
	?>
	<!-- Morris Charts CSS -->
    <link href="<?//=base_url('assets/app');?>/vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
	
	<!-- Data table CSS -->
	<link href="<?//=base_url('assets/app');?>/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	
	<?php
	}*/
	?>
	<link href="<?=base_url('assets/app');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	
	<!-- bootstrap-select CSS -->
	<link href="<?=base_url('assets/app');?>/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
	
	<?php
	if(!empty($active)){

		if($active == 'pharmacies' || $active == 'cart_index'){
	?>
	<link href="<?php echo base_url('assets/app');?>/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
	<?php
		}

		if($active == 'cart_index' || $active='w_invoice'){
	?>
	<style>
		.zoom_image{
			padding: 0;
			transition: transform .2s;
			margin: 0 auto;
		}
		
		.zoom_image:hover{
			-ms-transform: scale(2.9); /* IE 9 */
			-webkit-transform: scale(2.9); /* Safari 3-8 */
			transform: scale(2.9);
			cursor: zoom-in;
		}
		
		.disable_page{
			pointer-events: none;
		}
	</style>
	<?php
		}

		if($active == 'product_details'){
	?>
	<!-- bootstrap-touchspin CSS -->
	<link href="<?=base_url('assets/app');?>/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
	<?php
		}
	}
	?>

	<!-- Custom CSS -->
	<link href="<?=base_url('assets/app');?>/dist/css/style.css" rel="stylesheet" type="text/css">
	<!--autocomplete field-->
	<link rel="stylesheet" href="<?php echo base_url('assets/app');?>/autocomplete/autocomplete.css">

	<style>
	.panel-body h6, .long_text {
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
	}
	</style>
</head>

<body>