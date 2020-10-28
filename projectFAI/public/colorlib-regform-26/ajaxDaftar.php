
<?php
    require_once("conn.php");
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $pass = $_POST['pass'];  
    $cpass = $_POST['cpass'];  
    $mail = $_POST['mail'];  
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $kec = $_POST['kec'];
    $kategori = $_POST['kategori'];
    $halal = $_POST['halal'];
    $cek = 0;

    $listUser=mysqli_query($link,"SELECT * FROM merchant");
    $jumlah = mysqli_num_rows($listUser);
    foreach ($listUser as $user) {
        if($user['notelp']==$nohp){
            echo "No HP telah terdaftar";
            break;
        }
        else if($user['email']==$mail){
            echo "Email telah terdaftar";
            break;
        }
        else
        {
            $cek++;
        }
    }


    if($nama==""||$alamat==""||$nohp==""||$pass==""||$cpass==""||$email=""){
        echo "Field tidak boleh kosong!";

    }else if($pass!=$cpass){
        echo "Konfirmasi password tidak sesuai";            
    }else if (strpos($mail,"@") == false){
        echo "Email anda tidak valid";
    }else if(strlen($nohp)<10 || strlen($nohp)>13){ //coba di try catch  convert ke int , buat ngecek isine number semua ta gak
        echo "Nomor telepon tidak valid'";
    }else if(strlen($pass)<8){
        echo "Password tidak valid";
    }
    else if($cek==$jumlah)
    {   
        $jumlah= sprintf("%03d", $jumlah+1);
        $kat = substr($kategori,0,3);
        $id = strtoupper("MC".$kat.$jumlah);
        $id = $link->real_escape_string($id);
        $nama = $link->real_escape_string($nama);
        $kategori = $link->real_escape_string($kategori);
        $mail = $link->real_escape_string($mail);
        $alamat = $link->real_escape_string($alamat);
        $nohp = $link->real_escape_string($nohp);
        $pass = $link->real_escape_string($pass);
        $provinsi = $link->real_escape_string($provinsi);
        $kota = $link->real_escape_string($kota);
        $kec = $link->real_escape_string($kec);
        $halal = $link->real_escape_string($halal);
        // $vkey = md5(time().$nama);
        $pass = md5($pass);
        // echo $vkey;
        $insert = mysqli_query($link,"INSERT INTO merchant(id,nama,kategori,rating,alamat,notelp,pass,email,provinsi,kota,kecamatan,halal,status,vkey) VALUES('$id','$nama','$kategori',0,'$alamat','$nohp','$pass','$mail','$provinsi','$kota','$kec','$halal',0,'')");
        if($insert){
            echo "sukses";  // kalo berhasil pindah e di 'succes' nde ajax
            // header("location:thankyou.php");
        }
    }



?>