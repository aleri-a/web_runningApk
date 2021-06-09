<?php 
    //ova stranica se ne prikazuje sluzi samo da redirektuje, pa zato nema header i futer deo
    require_once 'db/conn.php';

//Get values from post operation from page editoneperson.php
if(isset($_POST['change']))
{
    $id=$_POST['person_idd'];
    $fname= $_POST['firstName'];
    $lname= $_POST['lastName'];
    $specialty= $_POST['specialty'];
    $contact= $_POST['phone'];
    $dob= $_POST['dob'];
    $email= $_POST['email'];
    
    //call Crud function
    
    $res=$crudDB->editOnePerson($id,$fname,$lname,$dob,$email,$contact,$specialty);
    //Redirect to index.php 
    if($res)
    {
        header("Location: viewallpeople.php");
    }
    else
    {
        include 'includes/errormessage.php';
        header("Location: viewallpeople.php");
    }
}
else
{
    include 'includes/errormessage.php';
    
}

?>