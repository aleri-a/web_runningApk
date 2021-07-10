<?php 
    $title= 'Index';
    require_once 'includes/header.php';
    require_once 'db/conn.php';

    $resultsSpecialties=$crudDB->getSpecialties();

    if(isset($_SESSION['userid']))
    {
   // echo "TVOJ userid SESSION:    ".$_SESSION['userid'];    
   
    } 

?>

<div id='IndexStrana'>

 <h1><i> Welcome to the application for 
     managing different running competitions </i></h1>

     <br><br>

     <img id='slika 'src="slika2.jpeg" alt="picture runners" width=100% height='auto'>
     <label for='slika'>Source: https://www.pexels.com/@runffwpu </label>


</div>


<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>