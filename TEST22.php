<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php'; 

$email = $_POST['email'];
$password = $_POST['password'];

// Ambil user berdasarkan email
$query = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn, $query);

// Cek hasil query
if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // Verifikasi password (karena sudah di-hash saat register)
    if (password_verify($password, $data['password'])) {
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $data['email'];
        
        header("Location: index.php");
        exit;
    } else {
        echo "<script>
            alert('Password salah!');
            window.location.href = 'Login.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Email tidak ditemukan!');
        window.location.href = 'Login.php';
    </script>";
}


mysqli_close($conn);
?>
