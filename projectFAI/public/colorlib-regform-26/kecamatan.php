
<?php
    require("conn.php");
    $kota = $_POST['kota'];
    // echo $kota;
    $listKota = mysqli_query($link,"SELECT id_kota FROM kota where nama_kota = '$kota'");
    $query=mysqli_fetch_assoc($listKota);
    $id=$query["id_kota"];
    $listKec = mysqli_query($link,"SELECT * FROM kecamatan");
    $select2 = -1;
    foreach($listKec as $kec) 
    {
        if($kec['id_kota'] == $id){
            if($select2 == -1){
                echo "<option selected='selected' name=".$kec[id_kec].">".$kec[nama_kec]."</option>";
                $select2 = 0;
            }else{
                echo "<option name=".$kec[id_kec].">".$kec[nama_kec]."</option>";
            }
        }
        
    }    
    
        
?>
