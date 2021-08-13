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
        * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        }

        body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Times New Roman";
        }
/* LEMBAR HALAMAN A4 */
        .page{
            width: 210mm;
            min-height: 297mm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        @page {
            size: A4;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;        
            }
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
/* LEMBAR HALAMAN A4 */
        .header{
            margin: 0cm auto;
            text-align: center;
        }
        .logo, .header-title{
            display: inline-block;
        }
        .logo img{
            width: 2.3cm;
        }
        .header p{
            text-align: center;
            margin: 0px auto;
            padding: 4px;
            font-weight: bold;
            font-size: 20px;
        }
        /* .spasi{
            min-width:7cm;
        } */
        table{
            margin: 0.5cm auto;
            text-align:left;
            width:100%;
        }
        .identitas{
            width:3cm;
            font-weight:normal;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            <div class="logo"><img src="assets/SDIT Al Husna.png" alt=""></div>
            <div class="header-title">
                <p>LAPORAN PENILAIAN TENGAH SEMESTER</p>
                <p>SD INTEGRAL AL HUSNA</p>
                <P>TAHUN PELAJARAN 2021/2022</P>
            </div>
        </div>

        <?php while($rows=mysqli_fetch_array($result)){?>
        <table>
            <tr>
                <th class="identitas">Nama Siswa</th>
                <td>:</td>
                <td style="max-width:5cm; min-width:5cm; font-weight:bold;"><?php echo $rows['nama_siswa']; ?></td>
                <td class="spasi"></td>
                <th class="identitas">Kelas</th>
                <td>:</td>
                <td><?php echo $rows['kelas']; ?></td>
            </tr>
            <tr>
                <th class="identitas">NIS</th>
                <td>:</td>
                <td><?php echo $rows['nis_siswa']; ?></td>
                <td class="spasi"></td>
                <th class="identitas">Semester</th>
                <td>:</td>
                <td>Ganjil</td>
            </tr>
            <tr>
                <th class="identitas">NISN</th>
                <td>:</td>
                <td><?php echo $rows['nisn_siswa']; ?></td>
                <td class="spasi"></td>
                <th class="identitas">Nama Sekolah</th>
                <td>:</td>
                <td>SD Integral Al Husna</td>
            </tr>
        </table>
        
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