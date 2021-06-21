<?php 
    //ova stranica se ne prikazuje sluzi samo da redirektuje, pa zato nema header i futer deo
    require_once 'db/conn.php';

//Get values from post operation from page editoneteam.php
if(isset($_POST['changeTeam']))
{
    $id=$_POST['team_id'];
    $name= $_POST['name'];
    $parentTeam= $_POST['perentTeam'];
    
    
    //call Crud function
    
    $res=$teamDB->updateOneTeam($id,$name,$parentTeam);
    
    if($res)
    {
        header("Location: viewallteams.php");
    }
    else
    {
        include 'includes/errormessage.php';
        header("Location: viewallteams.php");
    }
}
else
{
    include 'includes/errormessage.php';
    
}

?>