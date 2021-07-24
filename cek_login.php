<?php
session_start();

include_once("config.php");

$nama_akun = $_POST['nama_akun'];
$pass_akun = $_POST['pass_akun'];

$data = mysqli_query($mysqli,"SELECT * FROM akun WHERE nama_akun='$nama_akun' AND pass_akun='$pass_akun'");
$cek = mysqli_num_rows($data);

$rows=mysqli_fetch_array($data);

if($cek > 0){
    $_SESSION['nama_akun']=$nama_akun;
    $_SESSION['sebagai_akun']=$rows['sebagai_akun'];
    $_SESSION['role_akun']=$rows['role_akun'];
    $_SESSION['status'] = "login";
    header("Location:index.php");
} else {
    header("Location:login.php?pesan=gagal");
}
?>