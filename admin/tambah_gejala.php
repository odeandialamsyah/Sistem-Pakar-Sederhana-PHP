<?php
include '../admin/header.php';
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_gejala = $_POST['nama_gejala'];
    $query = "INSERT INTO gejala (nama_gejala) VALUES ('$nama_gejala')";
    if (mysqli_query($conn, $query)) {
        header('Location: manajemen_data.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
    <h1>Tambah Gejala</h1>
    <form action="" method="post">
        <label>Nama Gejala: <input type="text" name="nama_gejala" required></label><br>
        <button type="submit">Tambah</button>
    </form>
<?php include '../admin/footer.php'; ?>
