<?php
// Create database connection using config file
include_once("config.php");
 
$kelas = $_GET['kelas'];
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT datasiswa.no_siswa, nilaiptspkn.no_ptspkn, datasiswa.nisn_siswa, datasiswa.nama_siswa, nilaiptspkn.ptspkn31, nilaiptspkn.ptspkn32, nilaiptspkn.ptspkn33, nilaiptspkn.ptspkn34 FROM datasiswa, nilaiptspkn WHERE datasiswa.no_siswa=nilaiptspkn.no_ptspkn AND datasiswa.kelas='$kelas';");
?>
<html>
<head>    
    <title>Menampilkan Data</title>
</head>
 
<body>
	<a href="tampilmapel.php">Kembali></a>
	<?php 
		if($_GET['nilai']=='ptspkn31'){
			echo "<form name='inputptspkn' method='post' action="."masterinputnilaicopy.php?nilai=ptspkn31".">";
			} elseif ($_GET['nilai']=='ptspkn32') {
			echo "<form name='inputptspkn' method='post' action="."masterinputnilaicopy.php?nilai=ptspkn32".">";
			} elseif ($_GET['nilai']=='ptspkn33') {
				echo "<form name='inputptspkn' method='post' action="."masterinputnilaicopy.php?nilai=ptspkn33".">";
			} else {echo "<form name='inputptspkn' method='post' action="."masterinputnilaicopy.php?nilai=ptspkn34".">";} 
	?>
		<table>
			<tr>
				<th>No.</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
				<th>Nilai</th>
			</tr>

			<?php while($rows=mysqli_fetch_array($result)){?>			
			<tr>
				<td>
					<input readonly style="height:30px;" size="2" readonly name="no_ptspkn[]" type="text" id="no_ptspkn" value="<?php echo $rows['no_ptspkn']; ?>">
				</td>
				<td>
					<input size="10" disabled name="nisn_siswa[]" type="text" id="nisn_siswa" value="<?php echo $rows['nisn_siswa']; ?>">
				</td>
				<td>
					<input size="50" disabled name="nama_siswa[]" type="text" id="nama_siswa" value="<?php echo $rows['nama_siswa']; ?>">		
				</td>
				<td>
					<?php 
					if($_GET['nilai']=='ptspkn31'){
						echo "<input size='3' name='ptspkn31[]' type='number' min='0' max='100' id='ptspkn31' value='".$rows['ptspkn31']."'>";
					} elseif ($_GET['nilai']=='ptspkn32') {
						echo "<input size='3' name='ptspkn32[]' type='number' min='0' max='100' id='ptspkn32' value='".$rows['ptspkn32']."'>";
					} elseif ($_GET['nilai']=='ptspkn33') {
						echo "<input size='3' name='ptspkn33[]' type='number' min='0' max='100' id='ptspkn33' value='".$rows['ptspkn33']."'>";
					} else {echo "<input size='3' name='ptspkn34[]' type='number' min='0' max='100' id='ptspkn34' value='".$rows['ptspkn34']."'>";} 
					?>
				</td>
			</tr>
			<?php }; ?>
			<tr>
				<td><input type="submit" name="inputptspkn" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php
/* Check if button name "Submit" is active, do this */
if(isset($_POST['inputptspkn'])){
	if($_GET['nilai']=='ptspkn31'){
		$count=count($_POST["no_ptspkn"]);
			for($i=0;$i<$count;$i++){	
					$sql1="UPDATE nilaiptspkn SET ptspkn31='" . $_POST['ptspkn31'][$i]. "' WHERE no_ptspkn='" . $_POST['no_ptspkn'][$i] . "'";
					$result1=mysqli_query($mysqli,$sql1);
					header("Location: masterinputnilaicopy.php?nilai=ptspkn31");
		}
	}
	elseif($_GET['nilai']=='ptspkn32'){
		$count=count($_POST["no_ptspkn"]);
			for($i=0;$i<$count;$i++){	
					$sql1="UPDATE nilaiptspkn SET ptspkn32='" . $_POST['ptspkn32'][$i]. "' WHERE no_ptspkn='" . $_POST['no_ptspkn'][$i] . "'";
					$result1=mysqli_query($mysqli,$sql1);
					header("Location: masterinputnilaicopy.php?nilai=ptspkn32");
		}
	}	
	elseif($_GET['nilai']=='ptspkn33'){
		$count=count($_POST["no_ptspkn"]);
			for($i=0;$i<$count;$i++){	
					$sql1="UPDATE nilaiptspkn SET ptspkn33='" . $_POST['ptspkn33'][$i]. "' WHERE no_ptspkn='" . $_POST['no_ptspkn'][$i] . "'";
					$result1=mysqli_query($mysqli,$sql1);
					header("Location: masterinputnilaicopy.php?nilai=ptspkn33");
		}
	}	
	else{
		$count=count($_POST["no_ptspkn"]);
			for($i=0;$i<$count;$i++){	
					$sql1="UPDATE nilaiptspkn SET ptspkn34='" . $_POST['ptspkn34'][$i]. "' WHERE no_ptspkn='" . $_POST['no_ptspkn'][$i] . "'";
					$result1=mysqli_query($mysqli,$sql1);
					header("Location: masterinputnilaicopy.php?nilai=ptspkn34");
		}
	}		
}
mysqli_close($mysqli);

// source : https://t4tutorials.com/update-and-delete-multiple-records-together-in-php-mysql/
// https://www.studentstutorial.com/php/php-update-multiple-row
?>