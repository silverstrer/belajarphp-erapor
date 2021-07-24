<?php
// Create database connection using config file
include_once("config.php");
 
$no_siswa = $_GET['no_siswa'];

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM datasiswa WHERE no_siswa = '$no_siswa'");

while($datasiswa = mysqli_fetch_array($result)){
?>
<html>
<head>    
    <title>Menampilkan Data</title>
    <link rel="stylesheet" href="style.css">
</head>
 
<body>
<h2>Input Data Siswa</h2>
	<form name="editdatasiswa" method="post" action="editdata.php">
        <table>
            <tr>
                <td><label for="no_siswa">No. Siswa</label></td>
                <td><input readonly style="height:30px;" size="10" name="no_siswa" type="text" id="no_siswa" value="<?php echo $no_siswa;?>" ></td>
            </tr>
            <tr>
                <td><label for="nis_siswa">NIS</label></td>
                <td><input  style="height:30px;" size="10" name="nis_siswa" type="text" id="nis_siswa" value="<?php echo $datasiswa['nis_siswa']; ?>"></td>
            </tr>
            <tr>
                <td><label for="nisn_siswa">NISN</label></td>
                <td><input  style="height:30px;" size="10" name="nisn_siswa" type="text" id="nisn_siswa" value="<?php echo $datasiswa['nisn_siswa']; ?>"></td>
            </tr>
            <tr>
                <td><label for="nama_siswa">Nama Siswa</label></td>
                <td><input required style="height:30px;" size="50" name="nama_siswa" type="text" id="nama_siswa" value="<?php echo $datasiswa['nama_siswa']; ?>"></td>
            </tr>
            <tr>
                <td><label for="kelas">Kelas</label></td>
                <td><select style="height:30px;" name="kelas" id="kelas">
                    <option value="<?php echo $datasiswa['kelas'];?>"> <?php echo $datasiswa['kelas'];?> </option>
                    <option value="I (satu)">I (satu)</option>
                    <option value="II (dua )">II (dua)</option>
                    <option value="III (tiga)">III (tiga)</option>
                    <option value="IV (empat)">IV (empat)</option>
                    <option value="V (lima)">V (lima)</option>
                    <option value="VI (enam)">VI (enam)</option>
                </select></td>
            </tr>
            <tr>
                <td><label for="tempatlahir_siswa">Tempat lahir</label></td>
                <td><input  style="height:30px;" size="20" name="tempatlahir_siswa" type="text" id="tempatlahir_siswa" value="<?php echo $datasiswa['tempatlahir_siswa']; ?>" ></td>
            </tr>
            <tr>
                <td><label for="tgllahir_siswa">Tanggal lahir</label></td>
                <td><input  style="height:30px;" size="10" name="tgllahir_siswa" type="date" id="tgllahir_siswa" value="<?php echo $datasiswa['tgllahir_siswa']; ?>" ></td>
            </tr>
            <tr>
                <td><label for="kelamin_siswa">Jenis Kelamin </label></td>
                <td><select style="height:30px;" name="kelamin_siswa" id="kelamin_siswa">
                    <option value="<?php echo $datasiswa['kelamin_siswa']; ?>"> <?php echo $datasiswa['kelamin_siswa']; ?> </option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select></td>
            </tr>
            <tr>
                <td><label for="agama_siswa">Agama</label></td>
                <td><input  style="height:30px;" size="10" name="agama_siswa" type="text" id="agama_siswa" value="<?php echo $datasiswa['agama_siswa']; ?>" ></td>
            </tr>
            <tr>
                <td><label for="pendseb_siswa">Pendidikan Sebelumnya</label></td>
                <td><input  style="height:30px;" size="30" name="pendseb_siswa" type="text" id="pendseb_siswa" value="<?php echo $datasiswa['pendseb_siswa']; ?>" ></td>
            </tr>
            <tr>
                <td><label for="alamat_siswa">Alamat Siswa</label></td>
                <td><input  style="height:30px;" size="50" name="alamat_siswa" type="text" id="alamat_siswa" value="<?php echo $datasiswa['alamat_siswa']; ?>"></td>
            </tr>
        </table>
        <br>
		<input type="submit" name="editdatasiswa" value="Simpan"></td>
	</form>
    <?php }; ?>
</body>
</html>

<?php

include_once("config.php");

if(isset($_POST['editdatasiswa'])){
    $no_siswa = $_POST['no_siswa'];
	$nis_siswa = $_POST['nis_siswa'];
    $nisn_siswa = $_POST['nisn_siswa'];
    $nama_siswa = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $tempatlahir_siswa = $_POST['tempatlahir_siswa'];
    $tgllahir_siswa = $_POST['tgllahir_siswa'];
    $kelamin_siswa = $_POST['kelamin_siswa'];
    $agama_siswa = $_POST['agama_siswa'];
    $pendseb_siswa = $_POST['pendseb_siswa'];
    $alamat_siswa=$_POST['alamat_siswa'];

    $result = mysqli_query($mysqli,"UPDATE datasiswa SET no_siswa='$no_siswa', nis_siswa='$nis_siswa', nisn_siswa='$nisn_siswa', nama_siswa='$nama_siswa', kelas='$kelas', tempatlahir_siswa='$tempatlahir_siswa', tgllahir_siswa='$tgllahir_siswa', kelamin_siswa='$kelamin_siswa', agama_siswa='$agama_siswa', pendseb_siswa='$pendseb_siswa', alamat_siswa='$alamat_siswa' WHERE no_siswa=$no_siswa");

header("location:tampildata.php");

mysqli_close($mysqli);
}

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>