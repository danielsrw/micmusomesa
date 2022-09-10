<?php
	
	ob_start();
	session_start();
	include("admin/inc/config.php");
	include("admin/inc/functions.php");
	include("admin/inc/CSRF_Protect.php");
	$csrf = new CSRF_Protect();
	$error_message = '';
	$success_message = '';
	$error_message1 = '';
	$success_message1 = '';
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="img/logo.png">
	<meta name="author" content="CodePixar">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="./assets/fonts/flaticon/font/flaticon.css" />
    <link rel="stylesheet" href="./assets/fonts/icomoon/style.css" />
	<link rel="stylesheet" href="./assets/css/linearicons.css">
	<link rel="stylesheet" href="./assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="./assets/css/nice-select.css">
	<link rel="stylesheet" href="./assets/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="./assets/css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="./assets/css/bootstrap.css">
	<link rel="stylesheet" href="./assets/css/owl.carousel.css">
	<link rel="stylesheet" href="./assets/css/main.css">
