<?php
    include_once '../db/conn.php';

    
    if(isset($_REQUEST['idTeam']))
    {
       $people= $crudDB->getPeopleFromTeam($_REQUEST['idTeam']);
    }
    
    echo json_encode($people);
?>