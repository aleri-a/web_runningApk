<?php
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
        $result=$crud->deleteOnePerson($id);

        //Redirect to list
        if($result)
        {
            header("Location: index.php");
        }
        else
        {
            echo 'err deletepersn.php';
           include 'includes/errormessage.php';
        }

    }
?>