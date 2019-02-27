<?php require_once '../includes/db.php'; ?>
<?php require_once 'functions.php'; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php 

    if (!isset($_SESSION['role'])) {
        header("Location: ../index.php"); 
    }
 ?>

<!DOCTYPE html>
<html lang="utf-8">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

     <!-- Custom styles for this template-->
     <link href="css/sb-admin.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="css/style.css">
 
    <!-- google charts  SHOULD BE IN THE HEADER -->
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    
    <script src="vendor/jquery/jquery.min.js"></script>
    

  </head>

  <body id="page-top">