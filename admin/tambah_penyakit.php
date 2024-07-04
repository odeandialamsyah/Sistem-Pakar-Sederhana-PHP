<?php
include '../admin/header.php';
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_penyakit = $_POST['nama_penyakit'];
    $deskripsi = $_POST['deskripsi'];
    $query = "INSERT INTO penyakit (nama_penyakit, deskripsi) VALUES ('$nama_penyakit', '$deskripsi')";
    if (mysqli_query($conn, $query)) {
        header('Location: manajemen_data.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
    <h1>Tambah Penyakit</h1>
    <form action="" method="post">
        <label>Nama Penyakit: <input type="text" name="nama_penyakit" required></label><br>
        <label>Deskripsi: <textarea name="deskripsi" required></textarea></label><br>
        <button type="submit">Tambah</button>
    </form>
<?php include '../admin/footer.php'; ?>
