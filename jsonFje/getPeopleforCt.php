<?php
    include_once '../db/conn.php';

    if(isset($_REQUEST['idCt']))
    {
        $registredPpl=$ptDB->getPeopleforCtsql($_REQUEST['idCt'],$_REQUEST['teamId']);
        
    }
    
    echo json_encode($registredPpl);

?>