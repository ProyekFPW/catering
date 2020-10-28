<style>
    .grid-item{
            display:grid;
            width: auto;
            height: auto;
            align-content: center;
    }
</style>
<?php
    require("conn.php");
	require_once('mailer2/class.phpmailer.php');
    $listUser=mysqli_query($link,"SELECT * FROM merchant");
    $jumlah = 0;
    foreach($listUser as $user) 
    {
        $jumlah++;
    }    
    

    if(isset($_POST['toLog'])){
        header("location:login.php");
    }

    if(isset($_POST['toReg'])){
        header("location:index.php");
    }

    if(isset($_POST['reg']))
    {

        
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nohp = $_POST['telp'];
        $pass = $_POST['pass'];  
        $cpass = $_POST['cpass'];  
        $mail = $_POST['email'];  
        $provinsi = $_POST['prov'];
        $kota = $_POST['kota'];
        $kec = $_POST['kec'];
        $kategori = $_POST['kategori'];
        $halal = $_POST['my-checkbox'];

        $cek = 0;
    
        foreach ($listUser as $user) {
            if($user['notelp']==$nohp){
                echo "<script type='text/javascript'>alert('No HP telah terdaftar');</script>";
                break;
            }
            else if($user['email']==$mail){
                echo "<script type='text/javascript'>alert('Email telah terdaftar');</script>";
                break;
            }
            else
            {
                $cek++;
            }
        }


        if($nama==""||$alamat==""||$nohp==""||$pass==""||$cpass==""||$email=""){
            echo "<script type='text/javascript'>alert('Field tidak boleh kosong!');</script>";

        }else if($pass!=$cpass){
            echo "<scipt type='text/javascript'>alert('Konfirmasi password tidak sesuai')</script>";            
        }else if (strpos($mail,"@") == false){
            echo "<script type='text/javascript'>alert('Email anda tidak valid')</script>";
        }else if(strlen($nohp)<10 || strlen($nohp)>13){
            echo "<script type='text/javascript'>alert('Nomor telepon tidak valid')</script>";
        }else if(strlen($pass)<8){
            echo "<script type='text/javascript'>alert('Password tidak valid')</script>";
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
                header("location:thankyou.php");
            }
        }
       
    
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register Merchant</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		
			<div class="inner" style="border:none; width:100%; margin-top:-50px; top:20px;">
				<img src="images/image-4.png" alt="" style="left:-400px;" class="image-1">
				<div style="border:none; background:white; box-shadow:none;">
					<h3> Bibik's Catering</h3>
					<h3 style="font-size:10px;">Register Merchant</h3>
					<div class="form-holder">
						<span class="lnr lnr-user"></span>
						<input type="text" id="inpNama" class="form-control" placeholder="Nama" name="nama">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-phone-handset"></span>
						<input type="number" id="inpTelp" class="form-control" placeholder="Nomor Telepon" name="telp"><span id="pesan" style="left:320px;"></span>
					</div>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" id="inpEmail" class="form-control" placeholder="Email" name="email"><span id="pesan3" style="left:320px;"></span>
                    </div>
                    <label> Pilih provinsi </label>
                    <select class="form-control select2" style="width: 100%;" onchange="refreshKota()" name="prov" id="prov">
                    
                    <?php 
                    $listMerch=mysqli_query($link,"SELECT * FROM provinsi");
                    foreach($listMerch as $merch) 
                    {
                        if($merch['id_provinsi'] == 'PR004'){
                            echo "<option selected='selected' value=".$merch[id_provinsi].">".$merch[nama_provinsi]."</option>";
                        }else{
                            echo "<option value=".$merch[id_provinsi].">".$merch[nama_provinsi]."</option>";
                        }
                    }
                    ?>
                  </select>
                  
                    <label> Pilih kota </label>
                    <select class="form-control select2" id="kota" name="kota" style="width: 100%;">
                    <?php 
                    $listKota=mysqli_query($link,"SELECT * FROM kota");
                    $select2 = -1;
                    foreach($listKota as $kota) 
                    {
                        if($kota['id_kota'] == 'KO021'){
                            echo "<option selected='selected' name=".$kota[nama_kota].">".$kota[nama_kota]."</option>";
                        }else{
                            echo "<option name=".$kota[nama_kota].">".$kota[nama_kota]."</option>";
                        }
                        
                    }    
                    ?>
                  </select>
                    <label> Pilih kecamatan </label>
                    <select class="form-control select2" id="kec" name="kec" style="width: 100%;">
                    <?php 
                    $listKota=mysqli_query($link,"SELECT * FROM kecamatan");
                    $select2 = -1;
                    foreach($listKota as $kota) 
                    {
                        if($kota['id_kota'] == 'KO021'){
                            if($select2 == -1){
                                echo "<option selected='selected' name=".$kota[nama_kec].">".$kota[nama_kec]."</option>";
                                $select2 = 0;
                            }else{
                                echo "<option name=".$kota[nama_kec].">".$kota[nama_kec]."</option>";
                            }
                        }
                        
                    }    
                    ?>
                  </select>
                    <label> Pilih kategori </label>
                    <select class="form-control select2" id="kategori" name="kategori" style="width: 100%;">
                    <?php 
                    $listKat=mysqli_query($link,"SELECT * FROM kategori");
                    $select2 = -1;
                    foreach($listKat as $kat) 
                    {
                        echo "<option name=".$kat[nama_kategori].">".$kat[nama_kategori]."</option>";
                        
                    }    
                    ?>
                  </select>
                  <div class="form-holder" style="margin-top:20px;">
						<span class="lnr lnr-home"></span>
						<input type="text" class="form-control" placeholder="Alamat" id="inpAlamat" name="alamat">
					</div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
					</div>
                    <span style="top:710px;position:absolute;font-size:10px;">Password minimal 8 karakter</span>
					<div class="form-holder"style="padding-top:20px;">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" placeholder="Konfirmasi Password" name="cpass" id="cpass"><span id="pesan2" style="left:320px;"></span>
					</div>
					<div class="form-holder"style="padding-top:20px;">
                    <label>Apakah makanan yang anda sajikan HALAL?</label><br>
                    <input id="inpHalal"  type="checkbox" name="my-checkbox" value='1' checked="checked"> Ya
                    <!-- <input type="checkbox" name="my-checkbox" value='0'> Tidak -->
					</div>

                    <button onclick="daftar()"  name ="reg">Daftar</button>
                    <button onclick='toLogin()' class='btn btn-block bg-gradient-secondary btn-lg'>Masuk</button>
                    <h4 class="" style="text-align: center;"> Sudah Punya Akun ?? </h4>

				</div>
				<img src="images/image-2.png" alt="" class="image-2">
			
			
		
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<script>
    function cekuncek(){
            alert($("#inpHalal").is(":checked")); 
  
    }


    function daftar(){
    
        let nama     = $("#inpNama").val();
        let alamat   = $("#inpAlamat").val();
        let nohp     = $("#inpTelp").val();
        let pass     = $("#pass").val();
        let cpass    = $("#cpass").val();
        let mail     = $("#inpEmail").val();
        let provinsi = $("#prov").val();
        let kota     = $("#kota").val();
        let kec      = $("#kec").val();
        let kategori = $("#kategori").val();
        let halal    = 0;
        if($("#inpHalal").is(":checked")== true){
            halal =1;
        }else{  // false
            halal =0;
        }
        
            $.ajax({
                method: "post",
                url: "../../template%20log%20reg/colorlib-regform-26/ajaxDaftar.php",
                data: {
                    nama    :nama    ,
                    alamat  :alamat  ,
                    nohp    :nohp    ,
                    pass    :pass    ,
                    cpass   :cpass   ,
                    mail    :mail    ,
                    provinsi:provinsi,
                    kota    :kota    ,
                    kec     :kec     ,
                    kategori:kategori,
                    halal   :halal   ,
                },
                success: function (response) {
                    // alert(response);
                    if(response.match("sukses")){
                        // alert("masok");
                        // header("location:thankyou.php");
                        window.location.replace("../../template%20log%20reg/colorlib-regform-26/thankyou.php");
                    }else{
                        alert(response);
                    }
                    
                }
            });
    
    

    
    }

     function refreshKota(){
        prov = $("#prov").val();
        $.ajax({
            method:"post",
            url: "kota.php",
            data: {
                prov:prov
            },
            success: function (data) {
                $("#kota").html(data);
            }
        });
     }
     function refreshKec(){
        kota = $("#kota").val();
        $.ajax({
            method:"post",
            url: "kecamatan.php",
            data: {
                kota:kota
            },
            success: function (data) {
                $("#kec").html(data);
            }
        });
     }
     $('#cpass').keyup(function(){
        pass = $("#pass").val();
        cpass = $("#cpass").val();
        setTimeout(function(){
            $.ajax({
                method:"post",
                url: "cekPass.php",
                data: {
                    pass:pass,
                    cpass:cpass
                },
                success: function (data) {
                    $("#pesan2").html(data);

                }
            });
        },1000);
    });
    
     $("input[name=email]").keyup(function(){
        email = $("input[name=email]").val();
        setTimeout(function(){
            $.ajax({
                method:"post",
                url: "cekEmail.php",
                data: {
                    email:email
                },
                success: function (data) {
                    $("#pesan3").html(data);

                }
            });
        },1000);
    });
</script>
<!-- <style>
    .header{
        font-weight:bold;
    }
</style> -->