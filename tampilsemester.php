<?php
// Create database connection using config file
include_once("config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT * FROM semester ORDER BY id;");

$count=mysqli_num_rows($result);
?>
<html>
<head>    
    <title>Menampilkan Data Semester</title>
	<link rel="stylesheet" href="style.css">   
</head>
 
<body>
	<h1>Data Semester</h1>
	<a href="tahunpelajaran.php">Tambah data semester</a>
	<a href="index.php">Kembali</a>
		<table>
			<tr>
				<th  style="border: 1px solid black;">No.</th>
				<th  style="border: 1px solid black;">Status</th>
				<th  style="border: 1px solid black;">Tahun Pelajaran</th>
				<th  style="border: 1px solid black;">Semester</th>
				<th  style="border: 1px solid black;">Titi mangsa</th>
			</tr>
			<?php while($rows=mysqli_fetch_array($result)){?>
			<tr>
				<td  style="border: 1px solid black;">
					<?php echo $rows['id']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['status']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['tahun']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['semester']; ?>
				</td>
				<td  style="border: 1px solid black;">
					<?php echo $rows['titimangsa']; ?>
				</td>
				<td  style="border: 1px solid black;">
                    <a href="editsemester.php?id= <?php echo $rows['id']; ?>">edit </a>
					
				</td>
			</tr>
			<?php } ?>

		</table>
	</form>
</body>
</html>