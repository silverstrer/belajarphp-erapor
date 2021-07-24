<?php 
    if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			echo "Login gagal! username dan password salah!";
		}else if($_GET['pesan'] == "logout"){
			echo "Anda telah berhasil logout";
		}else if($_GET['pesan'] == "belum_login"){
			echo "Anda harus login untuk mengakses halaman admin";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>E-Raport</h1>
    <form action="cek_login.php" method="post" >
        <input type="text" name="nama_akun" id="nama_akun" placeholder="username">
        <input type="password" name="pass_akun" id="pass_akun" placeholder="password">
        <input type="submit" name="cek_login" value="Masuk">
    </form>
</body>
</html>