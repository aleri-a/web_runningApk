<?php
    include_once '../db/conn.php';

    
   
    if(isset($_REQUEST['idTeam']))
    {
        $teamsUnder=$teamDB->getChildrenAndGranchildren($_REQUEST['idTeam']); ;//->fetchAll();
    }
    
    echo json_encode($teamsUnder);

?>