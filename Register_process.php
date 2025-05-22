<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php'; 

echo 'password: ' . $_POST['password'] . '<br>';
echo 'confirm_password: ' . $_POST['confirm_password'] . '<br>';

$email = $_POST['email'];
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

// Validasi password dan confirmasi
if ($password !== $confirm_password) {
    echo "<script>
        alert('Confirmasi password tidak sesuai!');
        window.location.href = 'Register.php';
    </script>";
    exit;
}

// Cek apakah email sudah digunakan
$checkQuery = "SELECT * FROM user WHERE email = '$email'";
$checkResult = mysqli_query($conn, $checkQuery);

if ($checkResult && mysqli_num_rows($checkResult) > 0) {
    echo "<script>
        alert('Email sudah terdaftar!');
        window.location.href = 'Register.php';
    </script>";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$insertQuery = "INSERT INTO user (email, password) VALUES ('$email', '$hashedPassword')";
if (mysqli_query($conn, $insertQuery)) {
    echo "<script>
        alert('Registrasi berhasil! Silakan login.');
        window.location.href = 'Login.php';
    </script>";
} else {
    echo "<script>
        alert('Terjadi kesalahan saat registrasi!');
        window.location.href = 'Register.php';
    </script>";
}

mysqli_close($conn);
?>
