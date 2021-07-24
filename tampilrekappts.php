<?php
// Create database connection using config file
include_once("config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT nilaiptspkn.no_ptspkn, datasiswa.nisn_siswa, datasiswa.nama_siswa FROM datasiswa INNER JOIN nilaiptspkn ON datasiswa.no_siswa = nilaiptspkn.no_ptspkn ORDER BY nilaiptspkn.no_ptspkn;");

$count=mysqli_num_rows($result);
?>
<html>
<head>    
    <title>Menampilkan Data</title>
    <link rel="stylesheet" href="style.css">   
</head>
 
<body>
    <a href="tampilmapelpts.php">Kembali</a>
    <h1>Rekap Nilai PTS</h1>
		<table>
			<tr>
				<th>No.</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
                <th>PKN</th>
			</tr>
			<?php while($rows=mysqli_fetch_array($result)){?>
			<tr>
                <td>
                <?php echo $rows['no_ptspkn']; ?>
                </td>
				<td>
					<?php echo $rows['nisn_siswa']; ?>
				</td>
				<td>
					<?php echo $rows['nama_siswa']; ?>
				</td>
                <td>
                    <?php
                    // RUMUS RATA-RATA (AVERAGE)
                    include "config.php";
                    $query = mysqli_query($mysqli, "SELECT * FROM nilaiptspkn WHERE no_ptspkn='$rows[no_ptspkn]';");
                    $data    =mysqli_fetch_array($query);
                    $n_mapel    =array($data['ptspkn31'], $data['ptspkn32'], $data['ptspkn33'], $data['ptspkn34']);
                    $i = 0;
                    $cek = 0;
                    while($i < count($n_mapel)){
                        if($n_mapel[$i] > 0){
                            $cek += 1; 
                        }
                         $i++;
                    } 
                    echo $avg=array_sum($n_mapel)/$cek;
                    ?>
                </td>

			</tr>
            <?php } ?>
		</table>
</body>
</html>

<!-- https://www.rajaputramedia.com/artikel/script-php-menghitung-nilai-rata-rata.php -->
<!-- https://suckittrees.com/artikel-499/mencari-nilai-max-dan-min-di-php.html -->