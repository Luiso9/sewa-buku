<?php
session_start();
require_once '../lib/koneksi.php';

// Retrieve form inputs
$nm_pengguna = $_POST['nm_pengguna'];
$password = md5($_POST['password']);

// Query for login
$qlogin = "
    SELECT *
    FROM t_login
    WHERE nm_pengguna = ? AND katasandi = ?
";

// Prepare and execute the query
$stmt = $mysqli->prepare($qlogin);
$stmt->bind_param('ss', $nm_pengguna, $password);
$stmt->execute();
$rlogin = $stmt->get_result();
$jumlahbaris = $rlogin->num_rows;

if ($jumlahbaris > 0) {
    $dlogin = $rlogin->fetch_assoc();
    $_SESSION['katasandi'] = $dlogin['katasandi'];
    $_SESSION['nm_pengguna'] = $dlogin['nm_pengguna'];
    $_SESSION['status'] = $dlogin['status'];
    
    date_default_timezone_set("Asia/Brunei");
    $tanggalsekarang = date("Y-m-d H:i:s");
    
    // Update login time
    $zupdate = "
        UPDATE t_login SET jammasuk = ?
        WHERE katasandi = ?
    ";
    $stmt = $mysqli->prepare($zupdate);
    $stmt->bind_param('ss', $tanggalsekarang, $_SESSION['katasandi']);
    $stmt->execute();
    
    header('Location: adminmainapp.php?unit=dashboard');
} else {
    // Increment login attempts
    $qdatagrid = "
        UPDATE t_login SET bataslogin = bataslogin + 1
        WHERE nm_pengguna = ?
    ";
    $stmt = $mysqli->prepare($qdatagrid);
    $stmt->bind_param('s', $nm_pengguna);
    $stmt->execute();
    
    // Check attempts
    $c = "
        SELECT bataslogin
        FROM t_login
        WHERE nm_pengguna = ?
    ";
    $stmt = $mysqli->prepare($c);
    $stmt->bind_param('s', $nm_pengguna);
    $stmt->execute();
    $r = $stmt->get_result();
    $a = $r->fetch_assoc();
    $b = $a['bataslogin'];

    if ($b > 100000) {
        // Block user
        $mdatagrid = "
            UPDATE t_login SET blokir = 'Y'
            WHERE nm_pengguna = ?
        ";
        $stmt = $mysqli->prepare($mdatagrid);
        $stmt->bind_param('s', $nm_pengguna);
        $stmt->execute();

        echo "<script type='text/javascript'>
            alert('Nama pengguna $nm_pengguna telah diblokir. Silakan kirim pesan email ke admin@gmail.com untuk proses lebih lanjut.');
            window.location = './';
        </script>";
    } else {
        echo "<script type='text/javascript'>
            alert('Nama pengguna atau password tidak benar. Anda sudah $b kali mencoba.');
            window.location.href = './';
        </script>";
    }
}

// Close the statement and connection
$stmt->close();
$mysqli->close();
?>




?>