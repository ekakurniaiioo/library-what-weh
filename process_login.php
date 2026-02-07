<?php
session_start();
include 'koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data) {

    $password_db = $data['password'];

    if (password_verify($password, $password_db)) {

        $_SESSION['user_id'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
        $_SESSION['role'] = $data['role'];

    } elseif ($password === $password_db) {

        $newHash = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($koneksi, "UPDATE users SET password='$newHash' WHERE id_user='{$data['id']}'");

        $_SESSION['user_id'] = $data['id_users'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['email'] = $data['email'];

    }

    if (isset($_SESSION['role'])) {

        if ($_SESSION['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } elseif ($_SESSION['role'] === 'petugas') {
            header("Location: petugas/dashboard.php");
        } elseif ($_SESSION['role'] === 'pengguna') {
            header("Location: pengguna/home.php");
        } else {
            session_destroy();
            header("Location: login.php");
        }

    } else {
        header("Location: login.php");
    }

    exit;
}

echo "<script>
    alert('Username atau password salah');
    window.location='login.php';
</script>";
?>