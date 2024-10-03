<?php
// includes/db.php
$host = 'localhost';
$user = 'root'; // Sesuaikan dengan user MySQL Anda
$pass = '';     // Sesuaikan dengan password MySQL Anda
$db = 'db_nasabah';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}
?>
