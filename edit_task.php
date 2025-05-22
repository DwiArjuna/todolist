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

// Ambil data task
$stmt = $conn->prepare("SELECT * FROM todo_list WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Task tidak ditemukan atau bukan milik kamu.";
    exit;
}

$task = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/edit_task.css">
    <title>Edit Task</title>
</head>
<body>
<h2>Edit Task</h2>

<form method="POST">
    Judul: <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required><br>
    Deadline: <input type="date" name="deadline" value="<?= $task['deadline'] ?>" required><br>
    <button type="submit">Update</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];

    $update = $conn->prepare("UPDATE todo_list SET title = ?, deadline = ? WHERE id = ? AND user_id = ?");
    $update->bind_param("ssii", $title, $deadline, $id, $user_id);

    if ($update->execute()) {
        header("Location: index.php"); 
    } else {
        echo "Gagal mengupdate task: " . $conn->error;
    }
}
?>
</body>
</html>
