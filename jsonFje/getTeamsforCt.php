<?php
    include_once '../db/conn.php';

    
   
    if(isset($_REQUEST['idCt']))
    {
        $registredPt=$ptDB->getTeamsforCtsql($_REQUEST['idCt']) ;//->fetchAll();
    }
    
    echo json_encode($registredPt);

?>