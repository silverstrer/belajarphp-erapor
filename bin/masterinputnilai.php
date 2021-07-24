<!-- SELECT pelanggan.id_pelanggan, pelanggan.nm_pelanggan, pesan.id_pesan, pesan.tgl_pesan FROM pelanggan INNER JOIN pesan ON pelanggan.id_pelanggan=pesan.id_pelanggan; -->
<?php
// Create database connection using config file
include_once("config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT nilaiptspkn.no_ptspkn, datasiswa.nisn_siswa, datasiswa.nama_siswa, nilaiptspkn.ptspkn31 FROM datasiswa INNER JOIN nilaiptspkn ON datasiswa.no_siswa = nilaiptspkn.no_ptspkn ORDER BY nilaiptspkn.no_ptspkn;");

$count=mysqli_num_rows($result);
$no_urut = 0;
?>
<html>
<head>    
    <title>Menampilkan Data</title>
</head>
 
<body>
	<form name="inputptspkn" method="post" action="masterinputnilai.php">
		<table>
			<tr>
				<th></th>
				<th>No.</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
				<th>KD 3.1</th>
			</tr>
			<?php while($rows=mysqli_fetch_array($result)){ $no_urut++?>
			<tr>
				<td style="visibility:hidden">
					<input style="height:30px;" size="2" readonly name="no_ptspkn[]" type="text" id="no_ptspkn" value="<?php echo $rows['no_ptspkn']; ?>">
				</td>
				<td><?php echo $no_urut;?></td>
				<td>
					<input size="10" disabled name="nisn_siswa[]" type="text" id="nisn_siswa" value="<?php echo $rows['nisn_siswa']; ?>">
				</td>
				<td>
					<input size="50" disabled name="nama_siswa[]" type="text" id="nama_siswa" value="<?php echo $rows['nama_siswa']; ?>">
				</td>
				<td>
					<input size="3" name="ptspkn31[]" type="text" id="ptspkn31" value="<?php echo $rows['ptspkn31']; ?>">
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
$sql1="UPDATE nilaiptspkn SET ptspkn31='" . $_POST['ptspkn31'][$i]. "' WHERE no_ptspkn='" . $_POST['no_ptspkn'][$i] . "'";
$result1=mysqli_query($mysqli,$sql1);
header("Location: masterinputnilai.php");
}
}
echo $count;
mysqli_close($mysqli);

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>