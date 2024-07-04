<?php
include 'db.php';

$gejala = $_POST['gejala'];
$penyakit = [];

if (!empty($gejala)) {
    $gejala_list = implode(',', $gejala);

    $query = "SELECT penyakit.*, COUNT(relasi_gejala_penyakit.gejala_id) as jumlah_gejala
              FROM penyakit
              JOIN relasi_gejala_penyakit ON penyakit.id = relasi_gejala_penyakit.penyakit_id
              WHERE relasi_gejala_penyakit.gejala_id IN ($gejala_list)
              GROUP BY penyakit.id
              ORDER BY jumlah_gejala DESC
              LIMIT 1";

    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $penyakit = $row;
    }
}

if (!empty($penyakit)) {
    header('Location: hasil_diagnosis.php?penyakit_id=' . $penyakit['id']);
} else {
    echo 'Tidak dapat menemukan penyakit yang cocok dengan gejala yang Anda input.';
}
?>
