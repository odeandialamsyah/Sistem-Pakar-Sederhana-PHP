<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query)) {
        header('Location: login.php');
    } else {
        $error = 'Gagal mendaftarkan admin';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Admin</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Registrasi Admin</h1>
        <form action="register.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Daftar</button>
        </form>
        <?php if (isset($error)) echo '<p class="error">' . $error . '</p>'; ?>
    </div>
</body>
</html>
