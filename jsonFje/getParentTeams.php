<?php
    include_once '../db/conn.php';

    
    $allTeams=$teamDB->getParentTeams()->fetchAll();
    echo json_encode($allTeams);

?>