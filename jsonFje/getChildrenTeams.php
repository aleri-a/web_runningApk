<?php
    include_once '../db/conn.php';

    
    
    $children=null;
    
    
    if(isset($_REQUEST['idP']))
    {
       $children= $teamDB->getChildTeams($_REQUEST['idP']);
    }
    
    echo json_encode($children);
?>