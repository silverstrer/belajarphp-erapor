<?php
// Create database connection using config file
include("config.php");
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
    <style>
        .a4-paper{
            max-width:21cm;
            background:#eee;
        }
        .header{
            margin: 0cm 4cm;
        }
        .logo, .header-title{
            display: inline-block;
        }
        .header p{
            text-align: center;
            margin: 0px;
            padding: 4px;
            font-weight: bold;
            font-size: 20px;
        }

        .identitas{
            display:block;
            width:21cm;
            margin:0.3cm 2cm;
        }
        .identitas .identitas-kiri, .identitas-kanan{
            max-width:9cm;
            display:inline;
        }
        .identitas span{
            display: inline-block;
            width:9cm;
        }
    </style>
</head>
<body>
    <div class="a4-paper">
        <div class="header">
            <div class="logo">logo</div>
            <div class="header-title">
                <p>LAPORAN PENILAIAN TENGAH SEMESTER</p>
                <p>SD INTEGRAL AL HUSNA</p>
                <P>TAHUN PELAJARAN 2021/2022</P>
            </div>
        </div>

        <?php while($rows=mysqli_fetch_array($result)){?>
        <div class="identitas">
            <div class="identitas-kiri">
                <span>Nama : <?php echo $rows['nama_siswa']; ?></span>
                <span>No. Induk : <?php echo $rows['nis_siswa']; ?></span>
                <span>NISN : <?php echo $rows['nis_siswa']; ?> </span> 
            </div>
            <div class="identitas-kanan">
                <span>Kelas : <?php echo $rows['kelas']; ?></span>  
                <span>Semester : I / Ganjil</span>
                <span>Tahun Pelajaran : 2021/2022</span>  
            </div>

        </div>            

        
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
    </div>
    
</body>
</html>