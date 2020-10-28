
<?php
    require("conn.php");
    $prov = $_POST['prov'];
    echo $prov;
    $listKota=mysqli_query($link,"SELECT * FROM kota");
    $select2 = -1;
    foreach($listKota as $kota) 
    {
        if($kota['id_provinsi'] == $prov){
            if($select2 == -1){
                echo "<option selected='selected' name=".$kota[nama_kota].">".$kota[nama_kota]."</option>";
                $select2 = 0;
            }else{
                echo "<option name=".$kota[nama_kota].">".$kota[nama_kota]."</option>";
            }
        }
        
    }    
    
        
?>
