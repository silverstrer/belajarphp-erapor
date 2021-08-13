<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Raport</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:login.php?pesan=belum_login");
	}
?>
    <h1>Menu Utama</h1>
    <h3>Selamat datang <?php echo $_SESSION['sebagai_akun']; ?>!</h3>
    <a href="logout.php">Logout</a>
    
    <br>
    <br>
<?php 
    if($_SESSION['role_akun']=='admin'){
        echo "<a href='tampildata.php'>Data Siswa</a>";
        echo "<a href='tampilsemester.php'>Data Tahun Pelajaran</a>";
    }
?>
    
    <a href="">Input Nilai PH - Pengetahuan</a>
    <a href="">Input Nilai PH - Keterampilan</a>
    <a href="tampilmapelpts.php">Input Nilai PTS</a>
    <a href="">Input Nilai PAS/PAT</a>
    
</body>
</html>