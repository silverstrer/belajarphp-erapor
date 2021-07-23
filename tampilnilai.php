<!-- SELECT pelanggan.id_pelanggan, pelanggan.nm_pelanggan, pesan.id_pesan, pesan.tgl_pesan FROM pelanggan INNER JOIN pesan ON pelanggan.id_pelanggan=pesan.id_pelanggan; -->
<?php
// Create database connection using config file
include_once("config.php");
 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT nilaiptspkn.no_ptspkn, datasiswa.nisn_siswa, datasiswa.nama_siswa, nilaiptspkn.ptspkn31, nilaiptspkn.ptspkn32, nilaiptspkn.ptspkn33, nilaiptspkn.ptspkn34 FROM datasiswa INNER JOIN nilaiptspkn ON datasiswa.no_siswa = nilaiptspkn.no_ptspkn ORDER BY nilaiptspkn.no_ptspkn;");

$count=mysqli_num_rows($result);
$no_urut = 0;
?>
<html>
<head>    
    <title>Menampilkan Data</title>
</head>
 
<body>
		<table>
			<tr>
				<th>No.</th>
				<th>NISN</th>
				<th>Nama Siswa</th>
				<th>KD 3.1</th>
                <th>KD 3.2</th>
                <th>KD 3.3</th>
                <th>KD 3.4</th>
                <th>Rerata</th>
                <th>MAKS</th>
                <th>MIN</th>
			</tr>
			<?php while($rows=mysqli_fetch_array($result)){ $no_urut++?>
			<tr>
				<td><?php echo $no_urut;?></td>
				<td>
					<?php echo $rows['nisn_siswa']; ?>
				</td>
				<td>
					<?php echo $rows['nama_siswa']; ?>
				</td>
				<td>
                    <?php echo $rows['ptspkn31']; ?>
				</td>
                <td>
                    <?php echo $rows['ptspkn32']; ?>
				</td>
                <td>
                    <?php echo $rows['ptspkn33']; ?>
				</td>
                <td>
                    <?php echo $rows['ptspkn34']; ?>
				</td>

                    <?php
                        include "config.php";
                        $query = mysqli_query($mysqli, "SELECT * FROM nilaiptspkn WHERE no_ptspkn=$no_urut;");
                        $data    =mysqli_fetch_array($query);
                        $n_mapel    =array($data['ptspkn31'], $data['ptspkn32'], $data['ptspkn33'], $data['ptspkn34']);
                    ?>
                <td>
                    <?php
                    // RUMUS RATA-RATA (AVERAGE)
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

                <td>
                    <?php 
                        echo max($n_mapel);
                    ?>
                </td>
                <td>
                    <?php 
                        echo min($n_mapel);
                    ?>
                </td>
                <td>
                    <?php
                        switch(max($n_mapel)){
                            case $data['ptspkn31']:
                            echo "nilai kd 31 paling besar"; break;
                            case $data['ptspkn32']:
                            echo "nilai kd 32 paling besar"; break;
                            case $data['ptspkn33']:
                            echo "nilai kd 33 paling besar"; break;
                            case $data['ptspkn34']:
                            echo "nilai kd 34 paling besar"; break;
                        }
                    ?>
                </td>
                <td>
                    <?php
                        switch(min($n_mapel)){
                            case $data['ptspkn31']:
                            echo "nilai kd 31 paling kecil"; break;
                            case $data['ptspkn32']:
                            echo "nilai kd 32 paling kecil"; break;
                            case $data['ptspkn33']:
                            echo "nilai kd 33 paling kecil"; break;
                            case $data['ptspkn34']:
                            echo "nilai kd 34 paling kecil"; break;
                        }
                    ?>
                </td>
			</tr>
            <?php } ?>
		</table>
</body>
</html>

<!-- https://www.rajaputramedia.com/artikel/script-php-menghitung-nilai-rata-rata.php -->
<!-- https://suckittrees.com/artikel-499/mencari-nilai-max-dan-min-di-php.html -->