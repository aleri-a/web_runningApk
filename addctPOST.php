<?php 
//Ovaj koristimo tj u URL se ne vide info 
    $title= 'Add competition';
    require_once 'includes/header.php';
    require_once 'db/conn.php';


    //checking does variable exist, ie does button exists,  if not then we dont have other necessary info 
    // $crudDB variabla nam je u fajlu db/conn.php' tj na kraju, i to je objekat nase classes crud.php koja ima te fje osnovne insert koje vracaju true/false
    if(isset($_POST['submitCt'])){
        $competitionName= $_POST['competitionName'];
        $startDt= $_POST['startDt'];
        $endDt= $_POST['endDt'];
        $numPerTeam= $_POST['numPeopleTeam'];        
        $numBest= $_POST['numBest'];
        $distance= $_POST['distance'];
        $adminId=$_SESSION['userid'];
        //$adminId=2; //PROMENI NA KRAJU 

        $issuccess = $ctDB->insertCt( $competitionName,$startDt,$endDt,$numPerTeam,$numBest,$distance,$adminId);

        if($issuccess)
        {
            header("Location: viewallct.php");                
        }
        else 
        {           
            include 'includes/errormessage.php';
        }
    }
?>




<br>
<br>
<br>
<br>
<br>
 
<?php require_once 'includes/footer.php' ?>