<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];
$role     = 'petugas'; 

$cek = mysqli_query($koneksi, "SELECT id_user FROM users WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>
        alert('Username sudah dipakai!');
        window.location='registrasi.php';
    </script>";
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$query = mysqli_query($koneksi, "
    INSERT INTO users (username, password, role)
    VALUES ('$username', '$hash', '$role')
");

if ($query) {
    echo "<script>
        alert('Registrasi berhasil!');
        window.location='login.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>