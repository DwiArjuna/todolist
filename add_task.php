<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "Kamu harus login dulu.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Tambah Task</title></head>
<link rel="stylesheet" type="text/css" href="css/add_task.css">
<body>
<h2>Tambah Task</h2>
<form method="POST">
    Judul: <input type="text" name="title" required><br>
    Deadline: <input type="date" name="deadline" required><br>
    <button type="submit">Simpan</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    $status = 'pending';
    $user_id = $_SESSION['user_id']; 

    $stmt = $conn->prepare("INSERT INTO todo_list (user_id, title, deadline, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $title, $deadline, $status);
    
    if ($stmt->execute()) {
        header("Location: index.php"); 
    } else {
        echo "Gagal mengupdate task: " . $conn->error;
    }
}
?>
</body>
</html>
