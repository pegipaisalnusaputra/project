<?php
// administrator/register.php
include 'includes/db.php';
session_start();

// if (!isset($_SESSION['admin_id'])) {
//     header('Location: login.php');
// }

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // admin atau user

    // Cek apakah username sudah ada
    $query = "SELECT * FROM tb_users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username sudah terdaftar, gunakan username lain!');</script>";
    } else {
        // Insert user baru
        $query_insert = "INSERT INTO tb_users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $query_insert)) {
            echo "<script>alert('Akun berhasil didaftarkan!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal mendaftarkan akun!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Akun</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Daftarkan Akun Baru</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select class="form-control" name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <button type="submit" name="register" class="btn btn-primary">Daftar Akun</button>
    </form>
</div>
</body>
</html>
