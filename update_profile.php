<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update data user
    $stmt = $conn->prepare("UPDATE user SET username = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $email, $user_id);
    
    if ($stmt->execute()) {
        echo "Profil berhasil diperbarui. <a href='index.php'>Kembali</a>";
    } else {
        echo "Terjadi kesalahan.";
    }
}
?>
