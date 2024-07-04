<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

include '../admin/header.php';
include '../functions.php';

// Query untuk mengambil semua data gejala
$query = "SELECT * FROM gejala";
$result_gejala = mysqli_query($conn, $query);

// Query untuk mengambil semua data penyakit
$query = "SELECT * FROM penyakit";
$result_penyakit = mysqli_query($conn, $query);

// Query untuk mengambil hubungan gejala dengan penyakit
$query = "SELECT gp.id, g.nama_gejala, p.nama_penyakit
          FROM relasi_gejala_penyakit gp
          JOIN gejala g ON gp.gejala_id = g.id
          JOIN penyakit p ON gp.penyakit_id = p.id";
$result_relasi = mysqli_query($conn, $query);
?>
<h1>Manajemen Data</h1>

<h2>Gejala</h2>
<a class="link" href="tambah_gejala.php">Tambah Gejala</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Gejala</th>
        <th>Aksi</th>
    </tr>
    <?php
    $gejala = getAll('gejala');
    while ($row = mysqli_fetch_assoc($gejala)) {
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['nama_gejala'] . '</td>
                <td>
                    <a href="edit_gejala.php?id=' . $row['id'] . '">Edit</a> |
                    <a href="hapus_gejala.php?id=' . $row['id'] . '">Hapus</a>
                </td>
            </tr>';
    }
    ?>
</table>

<h2>Penyakit</h2>
<a class="link" href="tambah_penyakit.php">Tambah Penyakit</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Penyakit</th>
        <th>Aksi</th>
    </tr>
    <?php
    $penyakit = getAll('penyakit');
    while ($row = mysqli_fetch_assoc($penyakit)) {
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td>' . $row['nama_penyakit'] . '</td>
                <td>
                    <a href="edit_penyakit.php?id=' . $row['id'] . '">Edit</a> |
                    <a href="hapus_penyakit.php?id=' . $row['id'] . '">Hapus</a>
                </td>
            </tr>';
    }
    ?>
</table>

<h2>Relasi Gejala - Penyakit</h2>
<a class="link" href="tambah_relasi.php">Tambah Relasi</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama Gejala</th>
        <th>Nama Penyakit</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result_relasi)) : ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama_gejala'] ?></td>
            <td><?= $row['nama_penyakit'] ?></td>
            <td>
                <a href="edit_relasi.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="hapus_relasi.php?id=<?= $row['id'] ?>">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<?php include '../admin/footer.php'; ?>
