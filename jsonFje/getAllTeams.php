<?php
    include_once '../db/conn.php';

    
    $allTeams=$teamDB->getAllTeams()->fetchAll();//->fetchAll();
    echo json_encode($allTeams);

?>