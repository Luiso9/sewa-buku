<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'ryujin';

// Create a new MySQLi connection
$mysqli = new mysqli($server, $user, $password, $database);

// Check for connection errors
if ($mysqli->connect_errno) {
    // Output the error message and terminate the script
    echo "Koneksi ke database gagal: " . $mysqli->connect_error;
    exit(); // It's good practice to exit if a critical error occurs
} else {
    // Connection successful
    // echo "Koneksi Berhasil";
}

// Optionally, you can include this to close the connection
// $mysqli->close();
?>
