<?php
include 'includes/header.php';
include 'db.php';

$penyakit_id = $_GET['penyakit_id'];

$query = "SELECT * FROM penyakit WHERE id = $penyakit_id";
$result = mysqli_query($conn, $query);
$penyakit = mysqli_fetch_assoc($result);
?>
<div class="container">
    <h1>Hasil Diagnosis</h1>
    <h2><?php echo $penyakit['nama_penyakit']; ?></h2>
    <p><?php echo $penyakit['deskripsi']; ?> </p>
    <a href="input_gejala.php">Kembali ke Input Gejala</a>
</div>
<?php include 'includes/footer.php'; ?>
