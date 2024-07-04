<?php
include '../db.php';

$id = $_GET['id'];
$query = "DELETE FROM penyakit WHERE id = $id";
if (mysqli_query($conn, $query)) {
    header('Location: manajemen_data.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
