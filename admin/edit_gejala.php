<?php
include '../admin/header.php';
include '../db.php';

$id = $_GET['id'];
$query = "SELECT * FROM gejala WHERE id = $id";
$result = mysqli_query($conn, $query);
$gejala = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_gejala = $_POST['nama_gejala'];
    $query = "UPDATE gejala SET nama_gejala = '$nama_gejala' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manajemen_data.php');
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
    <h1>Edit Gejala</h1>
    <form action="" method="post">
        <label>Nama Gejala: <input type="text" name="nama_gejala" value="<?php echo $gejala['nama_gejala']; ?>" required></label><br>
        <button type="submit">Update</button>
    </form>
<?php include '../admin/footer.php'; ?>
