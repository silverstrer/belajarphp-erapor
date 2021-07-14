<!-- SELECT pelanggan.id_pelanggan, pelanggan.nm_pelanggan, pesan.id_pesan, pesan.tgl_pesan FROM pelanggan INNER JOIN pesan ON pelanggan.id_pelanggan=pesan.id_pelanggan; -->
<?php
// Create database connection using config file
include_once("config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT nilaiptspkn.no_ptspkn, datasiswa.nisn_siswa, datasiswa.nama_siswa, nilaiptspkn.nilai_ptspkn FROM datasiswa INNER JOIN nilaiptspkn ON datasiswa.no_siswa = nilaiptspkn.no_ptspkn ORDER BY nilaiptspkn.no_ptspkn;");

$count=mysqli_num_rows($result);
?>
<html>
<head>    
    <title>Menampilkan Data</title>
</head>
 
<body>
	<form name="inputptspkn" method="post" action="masterinput.php">
		<table>
			<tr>
				<th>No.</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
				<th>Nilai</th>
			</tr>
			<?php while($rows=mysqli_fetch_array($result)){ ?>
			<tr>
				<td>
					<input  style="height:30px;" size="2" readonly name="no_ptspkn[]" type="text" id="no_ptspkn" value="<?php echo $rows['no_ptspkn']; ?>">
				</td>
				<td>
					<input size="10" disabled name="nisn_siswa[]" type="text" id="nisn_siswa" value="<?php echo $rows['nisn_siswa']; ?>">
				</td>
				<td>
					<input size="50" disabled name="nama_siswa[]" type="text" id="nama_siswa" value="<?php echo $rows['nama_siswa']; ?>">
				</td>
				<td>
					<input size="3" name="nilai_ptspkn[]" type="text" id="nilai_ptspkn" value="<?php echo $rows['nilai_ptspkn']; ?>">
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td><input type="submit" name="inputptspkn" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php
/* Check if button name "Submit" is active, do this */
if(isset($_POST['inputptspkn']))
{
	$count=count($_POST["no_ptspkn"]);
	
for($i=0;$i<$count;$i++){
$sql1="UPDATE nilaiptspkn SET nilai_ptspkn='" . $_POST['nilai_ptspkn'][$i]. "' WHERE no_ptspkn='" . $_POST['no_ptspkn'][$i] . "'";
$result1=mysqli_query($mysqli,$sql1);
header("Location: masterinput.php");
}
}
echo $count;
mysqli_close($mysqli);

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>