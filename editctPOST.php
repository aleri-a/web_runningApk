<?php 
    //ova stranica se ne prikazuje sluzi samo da redirektuje, pa zato nema header i futer deo
    require_once 'includes/header.php';
    require_once 'db/conn.php';

//Get values from post operation from page editoneteam.php
if(isset($_POST['changeCt']))
{
        $id=$_POST['ct_id'];
        $competitionName= $_POST['competitionName'];
        $startDt= $_POST['startDt'];
        $endDt= $_POST['endDt'];
        $numPerTeam= $_POST['numPeopleTeam'];        
        $numBest= $_POST['numBest'];
        $distance= $_POST['distance'];
        $adminid=$_SESSION['userid'];
        $typect=$_POST['typect'];
       
        

        $issuccess = $ctDB->updateOneCt( $id,$competitionName,$startDt,$endDt,$numPerTeam,$numBest,$distance,$adminid,$typect);
                               

        if($issuccess)
        {
            header("Location: viewallct.php");                
        }
        else 
        {           
            include 'includes/errormessage.php';
        }
    
  
}
else
{
    include 'includes/errormessage.php';
    
}

?>