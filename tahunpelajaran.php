<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tahun Pelajaran</title>
</head>
<body>
    <h2>Input data semester</h2>
    <a href="tampilsemester.php">kembali</a>
    <form action="tahunpelajaran.php" name="tahunpelajaran" method="post">
        <table>
            <tr>
                <td> <input readonly type="text" name="id" id="id"> </td>
            </tr>
            <tr>
                <td> <label for="status"></label>Status</td>
                <td> <select style="height:30px;" name="status" id="status" placeholder="Pilih status semester">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select> </td>
            </tr>
            <tr>
                <td> <label for="tahun"></label> Tahun Pelajaran</td>
                <td> <input type="text" name="tahun" id="tahun" placeholder="tahun pelajaran"> </td>
            </tr>
            <tr>
                <td> <label for="semester"></label> Semester</td>
                <td> <select style="height:30px;" name="semester" id="semester" placeholder="Pilih semester">
                    <option value="ptsganjil">PTS Ganjil</option>
                    <option value="pasganjil">PAS Ganjil</option>
                    <option value="ptsgenap">PTS Genap</option>
                    <option value="patgenap">PAT Genap</option>
                </select> </td>
                <td>
                    <label for="titi">Titi Mangsa</label>
                    <input type="text" name="titi" id="titi" placeholder="tempat dan tanggal titi mangsa" size="30">
                </td>
            </tr>
        </table>
        <br>
		<input type="submit" name="tambahsemester" value="Simpan"></td>
    </form>
</body>
</html>

<?php

include_once("config.php");

if(isset($_POST['tambahsemester'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
	$tahun = $_POST['tahun'];
    $semester = $_POST['semester'];
    $titi = $_POST['titi'];

    $result = mysqli_query($mysqli,"INSERT INTO semester (id, status, tahun, semester, titimangsa) VALUES ('','$status','$tahun','$semester','$titi')");

    $datasiswa = mysqli_query($mysqli, "SELECT datasiswa.no_siswa, datasiswa.nis_siswa, datasiswa.nisn_siswa, datasiswa.nama_siswa, datasiswa.kelas FROM datasiswa ORDER BY datasiswa.no_siswa;");

    $count=mysqli_num_rows($datasiswa);

    echo "Data Semester berhasil ditambahkan. <a href='tampilsemester.php'>Oke</a><br>";
    echo "Jumlah data siswa di semester ini : "."$count";
        
mysqli_close($mysqli);
}

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>