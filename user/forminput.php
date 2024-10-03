<?php
// user/forminput.php
include 'includes/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../includes/PHPMailer/src/Exception.php';
require '../includes/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/src/SMTP.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Jika tombol submit ditekan
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $tanggal_input = date('Y-m-d'); // otomatis ambil tanggal hari ini

    // Mendapatkan data kredit dari input form dinamis
    $kredit_array = $_POST['kredit']; // array kredit dari input dinamis
    $total_kredit = 0;
    
    foreach ($kredit_array as $kredit) {
        $total_kredit += $kredit;
    }

    $persentase = 20; // 20% biaya admin
    $biaya_admin = ($total_kredit * $persentase) / 100; // Hitung biaya admin

    // Insert data ke dalam database tb_databeforeapprove
    $query = "INSERT INTO tb_databeforeapprove (nama, alamat, nohp, tanggal_input, total_kredit, biaya_admin, status, user_id) 
              VALUES ('$nama', '$alamat', '$nohp', '$tanggal_input', '$total_kredit', '$biaya_admin','pending','{$_SESSION['user_id']}')";

    if (mysqli_query($conn, $query)) {
        // Setelah berhasil insert, kirim email notifikasi ke administrator
        $mail = new PHPMailer(true);

        try {
            // Pengaturan server email
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'efaizal22@gmail.com';  // Email Gmail Anda
            $mail->Password = 'lzjarazjemorwlkt';  // Gunakan app password Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Penerima email
            $mail->setFrom('efaizal22@gmail.com', 'System');  // Email pengirim
            $mail->addAddress('suts30259@gmail.com', 'MabesAPK');  // Email penerima (admin)

            // Konten email
            $mail->isHTML(true);
            $mail->Subject = 'Nasabah Baru Menunggu Approval';
            $mail->Body    = 'Ada nasabah baru yang menunggu approval. <br><a href="http://localhost/administrator/belumapprove.php">Approve Sekarang</a>';

            $mail->send();
            echo "<script>alert('Data nasabah berhasil ditambahkan dan notifikasi telah dikirim ke administrator.'); window.location.href='index.php';</script>";
        } catch (Exception $e) {
            echo "Gagal mengirim email: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Gagal menambahkan data nasabah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Nasabah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Tambah Nasabah</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" name="nama" id="nama" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" name="alamat" id="alamat" required>
        </div>
        <div class="form-group">
            <label for="nohp">No HP:</label>
            <input type="text" class="form-control" name="nohp" id="nohp" required>
        </div>

        <div class="form-group">
            <label for="kredit">Kredit:</label>
            <div id="kreditFields">
                <div class="input-group mb-2">
                    <input type="number" class="form-control" name="kredit[]" placeholder="Masukkan jumlah kredit" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary addField" type="button">Tambah Kredit</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="persentase">Persentase Biaya Admin: 20%</label>
        </div>
        <div class="form-group">
            <label for="biaya_admin">Biaya Admin: (otomatis dihitung setelah input)</label>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
$(document).ready(function() {
    // Tambahkan input field kredit baru secara dinamis
    $('.addField').click(function() {
        $('#kreditFields').append(`
            <div class="input-group mb-2">
                <input type="number" class="form-control" name="kredit[]" placeholder="Masukkan jumlah kredit" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-danger removeField" type="button">Hapus</button>
                </div>
            </div>
        `);
    });

    // Hapus field kredit yang ditambahkan
    $(document).on('click', '.removeField', function() {
        $(this).closest('.input-group').remove();
    });
});
</script>

</body>
</html
