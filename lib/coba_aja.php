<?php
$server ='localhost';
$user   ='root';
$password ='';
$database ='coba_aja';

$mysqli = mysqli_connect($server, $user, $password, $database) or (mysqli_error($mysqli));
if (mysqli_connect_errno($mysqli)){
    echo 'koneksi ke databese belum berhasil'. mysqli_errno($mysqli);
    
}
 else {
   // echo 'Koneksi Berhasil';
}
