<?php
// Create database connection using config file
include("config.php");
$no_urut=$_GET['no_siswa'];
$kelas= $_GET['kelas'];
// Fetch all users data from database
$result = mysqli_query($mysqli, "SELECT datasiswa.no_siswa, datasiswa.nis_siswa, datasiswa.nisn_siswa, datasiswa.nama_siswa, datasiswa.kelas FROM datasiswa WHERE no_siswa='$no_urut'");

// $count=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil Raport PTS</title>
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
            padding: 1.5cm 2cm;
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

        hr{
            border: 1px solid black;
        }
        table{
            margin: 0.5cm auto;
            text-align:left;
            width:100%;
        }
        .identitas{
            width:3cm;
            font-weight:normal;
        }
        table .nilai, .nilai tr, .nilai th, .nilai td{
            border: 1px solid black;
        }
        table {
            border-collapse: collapse;
        }
        .nilai tr th{
            text-align: center;
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

        <hr>

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
                <!-- <th class="identitas">Nama Sekolah</th>
                <td>:</td>
                <td>SD Integral Al Husna</td> -->
            </tr>
        </table>
  
        <hr>

        <table class="nilai">
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">Mata Pelajaran</th>
                <th colspan="3">Nilai</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                <th>Angka</th>
                <th>Rata-rata</th>
                <th>Predikat</th>
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
                <td>
                    <?php echo $avg=array_sum($n_mapel)/$cek;

                    // Menghitung jumlah nilai rata-rata PKN
                    mysqli_query($mysqli, "UPDATE nilaiptspkn SET rataptspkn='$avg' WHERE no_ptspkn=$no_urut;");
                    $query =mysqli_query($mysqli, "SELECT rataptspkn FROM nilaiptspkn");
                    while ($data=mysqli_fetch_array($query)){
                        $jumlah[]=$data['rataptspkn'];
                    }
                    $total_nilai=array_sum($jumlah);
                    ?> 
                </td>

                <td>
                    <?php 
                    // Menampilkan nilai rata-rata kelas
                    if($kelas='I (satu)'){
                        $query = mysqli_query($mysqli, "SELECT no_siswa FROM datasiswa");
                        $count=mysqli_num_rows($query);
                        echo $avgs=number_format($total_nilai/$count,2);
                    }


                    ?>
                </td>
                <td> <?php if ($avg >= 85){echo "A";} 
                            elseif ($avg >= 75){ echo "B";}
                            elseif ($avg >= 65){ echo "C";}
                            else {echo "D";} ?> 
                </td>
                <td> <?php if ($avg >= 85){echo "Sangat baik";} 
                            elseif ($avg >= 75){ echo "Baik";}
                            elseif ($avg >= 65){ echo "Cukup";}
                            else {echo "Kurang";} ?> 
                </td>
            </tr>
        </table>
        <?php } ?>
    </div>
    
</body>
</html>