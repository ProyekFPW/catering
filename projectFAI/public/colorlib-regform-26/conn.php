<?php
    session_start();
    $_SESSION['status'] = -1;

    
    $link = mysqli_connect("localhost","root","","proyeksdp");
    if(!$link){
        echo "tidak dapat membaca DB";
        die();
    }
?>
