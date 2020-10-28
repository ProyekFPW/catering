<?php
    require("conn.php");
    if(isset($_POST['vkey'])){
        $vkey = $_POST['vkey'];
        // echo $vkey;
        $res=$link->query("SELECT status,vkey FROM merchant where status = 0 and vkey='$vkey' LIMIT 1");
        if($res->num_rows == 1){
            $update = mysqli_query($link,"update merchant set status = 1 where vkey='$vkey' LIMIT 1");
            if($update){
                echo "akun sudah terdaftar silahkan login";
                header('location:login.php');
            }
        }else{
            echo "akun sudah terverifikasi";
        }
    }
?>