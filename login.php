<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $username;
        header('Location: admin/manajemen_data.php');
    } else {
        $error = 'Username atau password salah';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-container">
    <h1>Login Admin</h1>
    <form action="login.php" method="post">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <button type="submit">Login</button>
        <span><a href="register.php">Daftar</a></span>
    </form>
    <?php if (isset($error)) echo '<p style="color: red;">' . $error . '</p>'; ?>
    </div>
</body>
</html>
