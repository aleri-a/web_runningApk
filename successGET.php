<?php 
// ovo je kad se gore vide info o osobi,  mi koristimo POST 
    $title= 'Success';
    require_once 'includes/header.php';
?>
<!-- 
<h1 class="text-center text-success" >
You have been Registred!
</h1> -->

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"> 
        <?php  echo $_GET['firstName'] . ' '. $_GET['lastName'];?>
    </h5>
    <h6 class="card-subtitle mb-2 text-muted">
    <?php echo $_GET['specialty'];?>
    </h6>
    <p class="card-text">
       Phone: <?php echo $_GET['phone']; ?>
    </p>

    <p class="card-text">
       Date of birth  <?php echo $_GET['dob']; ?>
    </p>

    <p class="card-text">
       Email: <?php echo $_GET['email']; ?>
    </p>

    <p class="card-text">
         <?php echo $_GET['InputPassword']; ?>
    </p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

<?php
    echo $_GET['firstName'] . ' '. $_GET['lastName']; //concatenation between 
    echo $_GET['specialty'];
    echo "<br>";
    echo $_GET['phone'];
    echo "<br>";
    echo $_GET['email'];
    echo "<br>";
    echo $_GET['InputPassword']." ".$_GET['dob'];
   


?>


<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>