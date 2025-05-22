<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Kamu harus login dulu.";
    exit;
}

if (!isset($_POST['id'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = $_POST['id'];
$user_id = $_SESSION['user_id'];

// Ambil status sekarang
$stmt = $conn->prepare("SELECT status FROM todo_list WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Task tidak ditemukan.";
    exit;
}

$task = $result->fetch_assoc();
$new_status = ($task['status'] === 'completed') ? 'pending' : 'completed';

// Update status
$update = $conn->prepare("UPDATE todo_list SET status = ? WHERE id = ? AND user_id = ?");
$update->bind_param("sii", $new_status, $id, $user_id);
$update->execute();

header("Location: index.php");
exit;
?>