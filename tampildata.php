<?php
// Create database connection using config file
include_once("config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT datasiswa.no_siswa, datasiswa.nis_siswa, datasiswa.nisn_siswa, datasiswa.nama_siswa, datasiswa.kelas FROM datasiswa ORDER BY datasiswa.no_siswa;");

$count=mysqli_num_rows($result);
?>
<html>
<head>    
    <title>Menampilkan Data</title>
</head>
 
<body>
		<table>
			<tr>
				<th  style="border: 1px solid black;">No.</th>
				<th  style="border: 1px solid black;">NIS</th>
				<th  style="border: 1px solid black;">NISN</th>
				<th  style="border: 1px solid black;">Nama Siswa</th>
				<th  style="border: 1px solid black;">Kelas</th>
				<th  style="border: 1px solid black;">Aksi</th>
			</tr>
			<?php while($rows=mysqli_fetch_array($result)){?>
			<tr>
				<td  style="border: 1px solid black;">
					<?php echo $rows['no_siswa']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['nis_siswa']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['nisn_siswa']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['nama_siswa']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['kelas']; ?>
				</td>
				<td  style="border: 1px solid black;">
                    <a href="editdata.php?no_siswa= <?php echo $rows['no_siswa']; ?>">edit </a>| <a href=""> raport</a>
				</td>
			</tr>
			<?php } ?>

		</table>
	</form>
</body>
</html>