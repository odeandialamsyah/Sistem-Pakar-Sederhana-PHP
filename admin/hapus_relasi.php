<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../db.php';

// Ambil ID relasi dari parameter URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: manajemen_data.php');
    exit();
}
$relasi_id = $_GET['id'];

// Query untuk menghapus relasi dari tabel relasi_gejala_penyakit
$query_delete = "DELETE FROM relasi_gejala_penyakit WHERE id = $relasi_id";
$result_delete = mysqli_query($conn, $query_delete);

if ($result_delete) {
    // Redirect kembali ke halaman manajemen_data.php atau halaman lain yang sesuai
    header('Location: manajemen_data.php');
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
