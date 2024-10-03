<?php
// administrator/belumapprove.php
include 'includes/db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}

$query = "SELECT * FROM tb_databeforeapprove WHERE status = 'pending'";
$result = mysqli_query($conn, $query);

if (isset($_POST['approve'])) {
    $nasabah_id = $_POST['nasabah_id'];
    
    // Ambil data nasabah
    $nasabah_query = "SELECT * FROM tb_databeforeapprove WHERE id = '$nasabah_id'";
    $nasabah_result = mysqli_query($conn, $nasabah_query);
    $nasabah_data = mysqli_fetch_assoc($nasabah_result);
    
    // Pindahkan data ke tb_dataafterapprove
    $query_insert = "INSERT INTO tb_dataafterapprove (user_id, nama, alamat, nohp, tanggal_input, total_kredit, biaya_admin) 
                     VALUES ('{$nasabah_data['user_id']}', '{$nasabah_data['nama']}', '{$nasabah_data['alamat']}', 
                             '{$nasabah_data['nohp']}', '{$nasabah_data['tanggal_input']}', 
                             '{$nasabah_data['total_kredit']}', '{$nasabah_data['biaya_admin']}')";
    mysqli_query($conn, $query_insert);
    
    // Hapus dari tb_databeforeapprove
    $query_delete = "DELETE FROM tb_databeforeapprove WHERE id = '$nasabah_id'";
    mysqli_query($conn, $query_delete);
    
    echo "<script>alert('Nasabah berhasil di-approve!'); window.location.href='belumapprove.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Approval Data Nasabah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Data Nasabah Belum Approve</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tanggal Input</th>
                <th>Total Kredit</th>
                <th>Biaya Admin</th>
                <th>Approve</th>
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
                    <td>{$row['total_kredit']}</td>
                    <td>{$row['biaya_admin']}</td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='nasabah_id' value='{$row['id']}'>
                            <button type='submit' name='approve' class='btn btn-success'>Approve</button>
                        </form>
                    </td>
                  </tr>";
            $no++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
