

<?php
    require("conn.php");
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if($cpass==""){

    }else if($pass!=$cpass ||strlen($pass)<8){
        echo "&#10008;";
    }else{
        echo"&#10004;";
    }

?>