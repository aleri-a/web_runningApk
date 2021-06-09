<?php
    require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo 
    require_once 'db/conn.php';
    if(!$_GET['id'])
    {
        include 'includes/errormessage.php';        
        header("Location: viewallpeople.php");
    }
    else
    {
        //Get ID values
        $id=$_GET['id'];
        //echo '<h1>'.$id.'</h1>';
        //Call Delete function
        $result=$crudDB->deleteOnePerson($id);

        //Redirect to list
        if($result)
        {
            header("Location: viewallpeople.php");
        }
        else
        {
            echo 'err deletepersn.php';
           include 'includes/errormessage.php';
        }

    }
?>