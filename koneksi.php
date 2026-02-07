<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$koneksi = mysqli_connect("localhost", "root", "", "library");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>