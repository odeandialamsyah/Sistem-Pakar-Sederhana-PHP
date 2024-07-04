<?php
// functions.php
include 'db.php';

// Fungsi untuk mendapatkan semua data dari tabel tertentu
function getAll($table) {
    $sql = "SELECT * FROM $table";
    return query($sql);
}

// Fungsi untuk mendapatkan satu baris data berdasarkan ID
function getById($table, $id) {
    $sql = "SELECT * FROM $table WHERE id = $id";
    $result = query($sql);
    return mysqli_fetch_assoc($result);
}

// Fungsi untuk menambah data ke tabel tertentu
function insert($table, $data) {
    global $conn;
    $columns = implode(", ", array_keys($data));
    $values = implode("', '", array_values($data));
    $sql = "INSERT INTO $table ($columns) VALUES ('$values')";
    return query($sql);
}

// Fungsi untuk mengupdate data di tabel tertentu berdasarkan ID
function update($table, $data, $id) {
    global $conn;
    $set = "";
    foreach ($data as $column => $value) {
        $set .= "$column = '$value', ";
    }
    $set = rtrim($set, ', ');
    $sql = "UPDATE $table SET $set WHERE id = $id";
    return query($sql);
}

// Fungsi untuk menghapus data dari tabel tertentu berdasarkan ID
function delete($table, $id) {
    $sql = "DELETE FROM $table WHERE id = $id";
    return query($sql);
}
?>
