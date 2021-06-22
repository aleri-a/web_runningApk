<?php 
    $title= 'Index';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsSpecialties=$crudDB->getSpecialties();

    if(isset($_SESSION['userid']))
    {
    echo "TVOJ userid SESSION:    ".$_SESSION['userid'];        
    } 

?>


<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>