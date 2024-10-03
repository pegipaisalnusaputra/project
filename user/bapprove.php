<?php
// user/bapprove.php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM tb_databeforeapprove WHERE user_id = '$user_id' AND status = 'pending'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Belum Approve</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Data Belum Approve</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tanggal Input</th>
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
                  </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
