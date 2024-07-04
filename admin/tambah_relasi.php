<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../admin/header.php';
include '../db.php';

// Ambil daftar gejala dari tabel gejala
$query_gejala = "SELECT * FROM gejala";
$result_gejala = mysqli_query($conn, $query_gejala);

// Ambil daftar penyakit dari tabel penyakit
$query_penyakit = "SELECT * FROM penyakit";
$result_penyakit = mysqli_query($conn, $query_penyakit);

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $gejala_id = $_POST['gejala_id'];
    $penyakit_id = $_POST['penyakit_id'];

    // Query untuk menyimpan relasi ke dalam tabel relasi_gejala_penyakit
    $query_insert = "INSERT INTO relasi_gejala_penyakit (gejala_id, penyakit_id) VALUES ('$gejala_id', '$penyakit_id')";
    $result_insert = mysqli_query($conn, $query_insert);

    if ($result_insert) {
        // Redirect kembali ke halaman manajemen_data.php atau halaman lain yang sesuai
        header('Location: manajemen_data.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h1>Tambah Relasi Gejala - Penyakit</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="gejala_id">Pilih Gejala:</label>
    <select name="gejala_id" id="gejala_id">
        <?php while ($row = mysqli_fetch_assoc($result_gejala)) : ?>
            <option value="<?= $row['id'] ?>"><?= $row['nama_gejala'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="penyakit_id">Pilih Penyakit:</label>
    <select name="penyakit_id" id="penyakit_id">
        <?php while ($row = mysqli_fetch_assoc($result_penyakit)) : ?>
            <option value="<?= $row['id'] ?>"><?= $row['nama_penyakit'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Simpan">
</form>

<?php include '../admin/footer.php'; ?>
