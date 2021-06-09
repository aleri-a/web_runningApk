<?php 

include_once 'includes/sessions.php' ?>
<?php
    session_destroy();
    echo 'sesion detroyed';
    header('Location: index.php');
?>