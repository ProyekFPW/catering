<?php
    require("conn.php");
    $listUser=mysqli_query($link,"SELECT * FROM merchant");
    $jumlah = 0;
    foreach($listUser as $user) 
    {
        $jumlah++;
    }    
    // var_dump($user);
    


    if(isset($_POST['reg'])){
        header("location:index.php");
    }
    if(isset($_POST['login']))
    {
        $cek = 0;
        $pass = $link->real_escape_string($_POST['pass']);  
        // $pass = substr(md5($pass),0,20); 
        $email = $link->real_escape_string($_POST['email']);   
        echo $pass;
        foreach ($listUser as $user) {
            $cek++;
            if($user['email']==$email && $user['pass']==$pass){
                echo "<script>alert('masuk')</script>";
                $_SESSION['status'] = $user['email'];
                header('location:../../web%20merchant/index.php');
                break;
            }
        } 
        
        if($cek==$jumlah){
            echo "<script>alert('password salah')</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>RegistrationForm_v10 by Colorlib</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="fonts/linearicons/style.css">
		
		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>

		<div class="wrapper">
			<div class="inner">
				<img src="images/image-4.png" alt="" style="left:-400px;" class="image-1">
				<form action="" method="post">
					<h3> Bibik's Catering</h3>
					<h3 style="font-size:5px;">Login Merchant</h3>
					<div class="form-holder">
						<span class="lnr lnr-envelope"></span>
						<input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
					<div class="form-holder">
						<span class="lnr lnr-lock"></span>
						<input type="password" class="form-control" placeholder="Password" name="pass">
					</div>
                    <button name="login">Login</button>
                    <button name="reg">Daftar</button>

				</form>
				<img src="images/image-2.png" alt="" class="image-2">
			</div>
			
		</div>
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>