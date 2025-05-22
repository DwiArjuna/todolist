<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email terdaftar
    $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password 
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; 
            header("Location: index.php");
            exit;
        } else {
            echo "<script>
                alert('Password salah!');
                window.location.href = 'Login.php'
                </script>";
        }
    } else {
        echo "<script>
            alert('Email tidak ditemukan!');
            window.location.href = 'Login.php';
        </script>";
    }
} else {
    echo "Akses tidak valid.";
}
?>
