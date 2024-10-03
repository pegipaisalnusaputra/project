<?php
// administrator/index.php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Selamat Datang, <?php echo $_SESSION['username']; ?></h2>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="daftarakun.php">Daftar Akun</a></li>
            <li class="nav-item"><a class="nav-link" href="belumapprove.php">Belum Approve</a></li>
            <li class="nav-item"><a class="nav-link" href="sudahapprove.php">Sudah Approve</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</div>
</body>
</html>
