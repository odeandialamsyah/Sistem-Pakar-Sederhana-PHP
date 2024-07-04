<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../admin/header.php';
include '../db.php';

// Ambil ID relasi dari parameter URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: manajemen_data.php');
    exit();
}
$relasi_id = $_GET['id'];

// Ambil data relasi yang akan di-edit dari database
$query_relasi = "SELECT * FROM relasi_gejala_penyakit WHERE id = $relasi_id";
$result_relasi = mysqli_query($conn, $query_relasi);
$row_relasi = mysqli_fetch_assoc($result_relasi);

if (!$row_relasi) {
    echo "Relasi tidak ditemukan.";
    exit();
}

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

    // Query untuk update relasi ke dalam tabel relasi_gejala_penyakit
    $query_update = "UPDATE relasi_gejala_penyakit SET gejala_id = '$gejala_id', penyakit_id = '$penyakit_id' WHERE id = $relasi_id";
    $result_update = mysqli_query($conn, $query_update);

    if ($result_update) {
        // Redirect kembali ke halaman manajemen_data.php atau halaman lain yang sesuai
        header('Location: manajemen_data.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h1>Edit Relasi Gejala - Penyakit</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $relasi_id; ?>">
    <label for="gejala_id">Pilih Gejala:</label>
    <select name="gejala_id" id="gejala_id">
        <?php while ($row = mysqli_fetch_assoc($result_gejala)) : ?>
            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $row_relasi['gejala_id']) ? 'selected' : ''; ?>><?= $row['nama_gejala'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <label for="penyakit_id">Pilih Penyakit:</label>
    <select name="penyakit_id" id="penyakit_id">
        <?php while ($row = mysqli_fetch_assoc($result_penyakit)) : ?>
            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $row_relasi['penyakit_id']) ? 'selected' : ''; ?>><?= $row['nama_penyakit'] ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <input type="submit" value="Simpan">
</form>

<?php include '../admin/footer.php'; ?>
