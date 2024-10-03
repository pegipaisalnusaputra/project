<?php
// administrator/sudahapprove.php
include 'includes/db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

$query = "SELECT * FROM tb_dataafterapprove";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sudah Approve</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Data Sudah Approve</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tanggal Input</th>
                <th>Biaya Admin</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['alamat']}</td>
                    <td>{$row['nohp']}</td>
                    <td>{$row['tanggal_input']}</td>
                    <td>{$row['biaya_admin']}</td>
                  </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
