<?php
include '../admin/header.php';
include '../db.php';

$id = $_GET['id'];
$query = "SELECT * FROM penyakit WHERE id = $id";
$result = mysqli_query($conn, $query);
$penyakit = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_penyakit = $_POST['nama_penyakit'];
    $deskripsi = $_POST['deskripsi'];
    $query = "UPDATE penyakit SET nama_penyakit = '$nama_penyakit', deskripsi = '$deskripsi' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manajemen_data.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
    <h1>Edit Penyakit</h1>
    <form action="" method="post">
        <label>Nama Penyakit: <input type="text" name="nama_penyakit" value="<?php echo $penyakit['nama_penyakit']; ?>" required></label><br>
        <label>Deskripsi: <textarea name="deskripsi" required><?php echo $penyakit['deskripsi']; ?></textarea></label><br>
        <button type="submit">Update</button>
    </form>
<?php include '../admin/footer.php'; ?>
