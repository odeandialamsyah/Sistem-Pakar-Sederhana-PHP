<?php

$servername = "localhost"; // atau nama server Anda
$username = "root"; // atau nama pengguna database Anda
$password = ""; // atau password database Anda
$dbname = "sistem_pakar"; // ganti dengan nama database Anda

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn)
{
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

function query($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die('Query failed: ' . mysqli_error($conn));
    }
    return $result;
}

?>