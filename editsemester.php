<?php
// Create database connection using config file
include_once("config.php");
 
$id = $_GET['id'];

// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM semester WHERE id = '$id'");

while($data = mysqli_fetch_array($result)){
?>
<html>
<head>    
    <title>Menampilkan Data Semester</title>
    <link rel="stylesheet" href="style.css">
</head>
 
<body>
<h2>Edit Data Semester</h2>
<a href="tampilsemester.php">kembali</a>
	<form name="editdatasemester" method="post" action="editsemester.php">
        <table>
            <tr>
                <td><label for="id">ID</label></td>
                <td><input readonly style="height:30px;" name="id" type="text" id="id" value="<?php echo $id;?>" ></td>
            </tr>
            <tr>
                <td><label for="status">Status</label></td>
                <td><select style="height:30px;" name="status" id="status">
                    <option value="<?php echo $data['status'];?>"> <?php echo $data['status'];?> </option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select></td>
            </tr>
            <tr>
                <td><label for="tahun">Tahun Pelajaran</label></td>
                <td><input  style="height:30px;" name="tahun" type="text" id="tahun" value="<?php echo $data['tahun']; ?>"></td>
            </tr>
            <tr>
                <td><label for="semester">Semester</label></td>
                <td><select style="height:30px;" name="semester" id="semester">
                    <option value="<?php echo $data['semester'];?>"> <?php echo $data['semester'];?> </option>
                    <option value="ptsganjil">PTS Ganjil</option>
                    <option value="pasganjil">PAS Ganjil</option>
                    <option value="ptsgenap">PTS Genap</option>
                    <option value="patgenap">PAT Genap</option>
                </select></td>
            </tr>
            <tr>
                <td><label for="titi">Titi mangsa</label></td>
                <td><input style="height:30px;" name="titi" type="text" id="titi" value="<?php echo $data['titimangsa']; ?>"></td>
            </tr>
        </table>
        <br>
		<input type="submit" name="editsemester" value="Simpan"></td>
	</form>
    <?php }; ?>
</body>
</html>

<?php

include_once("config.php");

if(isset($_POST['editsemester'])){
    $id = $_POST['id'];
    $status = $_POST['status'];
	$semester = $_POST['semester'];
    $tahun = $_POST['tahun'];
    $titi = $_POST['titi'];

    $result = mysqli_query($mysqli,"UPDATE semester SET id='$id', status='$status', semester='$semester', tahun='$tahun', titimangsa='$titi' WHERE id='$id'");

header("location:tampilsemester.php");

mysqli_close($mysqli);
}

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>