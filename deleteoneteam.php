<?php
    require_once 'includes/auth_check.php'; //da li je ta osoba autorizovana da vidi ovo tj inace da u urlu ukuca ovu skriptu  
    require_once 'db/conn.php';
    if(!$_GET['id'])
    {
        include 'includes/errormessage.php';        
        header("Location: viewallteams.php");
    }
    else
    {
        $id=$_GET['id'];        
        $result=$teamDB->deleteOneTeam($id);

        if($result)
        {
            header("Location: viewallteams.php");
        }
        else
        {
           include 'includes/errormessage.php';
        }

    }
?>