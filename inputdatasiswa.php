<html>
<head>    
    <title>Menampilkan Data</title>
</head>
 
<body>
	<form name="inputdatasiswa" method="post" action="inputdatasiswa.php">
        <label for="nis_siswa">NIS :</label>
		<input  style="height:30px;" size="2" name="nis_siswa[]" type="text" id="nis_siswa">
        <br>
        <br>
		<input type="submit" name="inputdatasiswa" value="Submit"></td>

	</form>
</body>
</html>

<?php
/* Check if button name "Submit" is active, do this */
if(isset($_POST['inputdatasiswa']))
{
	$nis_siswa=$_POST['nis_siswa'];

    include_once("config.php");

    $result = mysqli_query($mysqli,"INSERT INTO datasiswa(nis_siswa) VALUES ('$nis_siswa')");

    header("Location: masterinput.php");
    mysqli_close($mysqli);

}

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>