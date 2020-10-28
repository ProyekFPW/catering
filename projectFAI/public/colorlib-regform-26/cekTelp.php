

<?php
    require("conn.php");
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if($cpass==""){

    }else if($pass!=$cpass){
        echo "&#10008;";
    }else{
        echo"&#10004;";
    }

?>