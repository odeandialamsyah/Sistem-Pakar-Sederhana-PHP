<?php
include 'includes/header.php';
include 'db.php'; // koneksi ke database
?>
<div class="container">
    <h1>Input Gejala yang Anda Alami</h1>
    <form action="proses_gejala.php" method="post">
        <?php
        $query = "SELECT * FROM gejala";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<input type="checkbox" name="gejala[]" value="' . $row['id'] . '">' . $row['nama_gejala'] . '<br>';
        }
        ?>
        <button type="submit">Diagnosa</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>
