<?php 
  session_start();

  $servername = "localhost";
  $username = "root";
  $password = "";
  $db_name = "exam_system";
  $conn = mysqli_connect($servername,$username,$password,$db_name);
  if (!$conn) {
    die("Could not connect to database: " . mysqli_connect_error());
  }
  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Exam System | <?= $page_name ?></title>
        <link rel="icon" type="image/x-icon" href="../../assets/Akdeniz_university_logo.png" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="../../css/mystyle.css" rel="stylesheet" />
    </head>
    <body>