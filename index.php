<?php 
    $title= 'Index';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsSpecialties=$crudDB->getSpecialties();
?>


<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>