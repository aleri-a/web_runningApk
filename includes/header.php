<?php
//This includes session file. This file contains code that starts/rsume a session
//By having it in the header file, it willl be included on every page, allowing session capility to be used on every pade across website 
include_once 'includes/sessions.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <link rel="stylesheet" href="css/site.css" />

    <title>Attendace - <?php echo $title?></title>
  </head>
  <body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">Running APK (or logo)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse container" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
        <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="viewallpeople.php">Registred people</a>
      
      </div>
      <div class="navbar-nav ml-auto">
        <?php 
            if(!isset($_SESSION['userid']))
            {

        ?>
        <a class="nav-item nav-link " href="login.php">Login <span class="sr-only">(current)</span></a>

        <?php 
            }
            else{
        ?> 
        <a class="nav-item nav-link " href="#"><span> Hellooo Hello <?php echo $_SESSION['username'] ?>! </span> (currently)</a>  
        <!-- ovde mozda umesto hello helloo da stavis korisnikovu sliku ili tako nesto  -->
        <a class="nav-item nav-link " href="logout.php">Logout <span class="sr-only">(current)</span></a>
        <?php } ?>
      </div>
    </div>
</nav>


    <div class="container">
  <!-- NAVBAR -->
  <!-- href='strana na koju idu '-->
 
</br>