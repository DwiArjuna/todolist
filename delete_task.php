<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Kamu harus login dulu.";
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID task tidak ditemukan.";
    exit;
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM todo_list WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);

if ($stmt->execute()) {
    header("Location: index.php");
    exit;
} else {
    echo "Gagal menghapus task: " . $conn->error;
}
