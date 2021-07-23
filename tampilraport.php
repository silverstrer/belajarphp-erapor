<?php
// Create database connection using config file
include_once("config.php");
$no_urut=$_GET['no_siswa']; 
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT datasiswa.no_siswa, datasiswa.nis_siswa, datasiswa.nisn_siswa, datasiswa.nama_siswa, datasiswa.kelas FROM datasiswa WHERE no_siswa='$no_urut'");

$count=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Raport</title>
</head>
<body>
    <h4>LAPORAN PENILAIAN AKHIR SEMESTER</h4>
    <h4>SD INTEGRAL AL HUSNA KOTA TANGERANG</h4>
    <h4>TAHUN PELAJARAN 2021/2022</h4>

    <?php while($rows=mysqli_fetch_array($result)){?>
        <p> Nama : <?php echo $rows['nama_siswa']; ?> </p>
    
    <table>
        <tr>
            <th>No.</th>
            <th>Mata Pelajaran</th>
            <th>Angka</th>
            <th>Predikat</th>
            <th>Deskripsi</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Pendidikan Kewarganegaraan</td>
                <?php
                    include "config.php";
                    $no_urut=$_GET['no_siswa'];
                    $query = mysqli_query($mysqli, "SELECT * FROM nilaiptspkn WHERE no_ptspkn=$no_urut;");
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
                ?>
            <td> <?php echo $avg=array_sum($n_mapel)/$cek; ?> </td>
            <td> <?php if ($avg >= 85){echo "A";} 
                        elseif ($avg >= 75){ echo "B";}
                        elseif ($avg >= 65){ echo "C";}
                        else {echo "D";} ?> 
            </td>
            <td>
                <?php
                    switch(max($n_mapel)){
                        case $data['ptspkn31']:
                        echo $rows['nama_siswa']."nilai kd 31 paling besar"; break;
                        case $data['ptspkn32']:
                        echo $rows['nama_siswa']." nilai kd 32 paling besar, "; break;
                        case $data['ptspkn33']:
                        echo $rows['nama_siswa']."nilai kd 33 paling besar"; break;
                        case $data['ptspkn34']:
                        echo $rows['nama_siswa']."nilai kd 34 paling besar"; break;
                        }
                ?>
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
    </table>
    <?php } ?>
</body>
</html>