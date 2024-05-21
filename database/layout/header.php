<?php 
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "library_management";
  $conn = mysqli_connect($servername,$username,$password,$db_name);
  if (!$conn) {
    die("Could not connect to database: " . mysqli_connect_error());
  }
  
?>
<!--HEADER-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Library Management System</title>
        <link rel="icon" type="image/x-icon" href="/database/assets/Akdeniz_university_logo.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="/database/css/styles.css" rel="stylesheet" />
        <link href="/database/css/mystyle.css" rel="stylesheet" />
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        

        <!-- Core theme JS-->
        <script src="/database/js/scripts.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="/database/js/jquery-3.7.1.min.js"></script>
        <script src="/database/js/custom.js"></script>
        
    </head>
    <body>