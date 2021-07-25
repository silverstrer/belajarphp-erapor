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
                    $avgptspkn=array_sum($n_mapel)/$cek;

?>
