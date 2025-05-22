<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Kamu Harus Login Dulu!');
            window.location.href = 'Login.php';
        </script>";
    exit;
}
$user_id = $_SESSION['user_id'];
$search = isset($_GET['search']) ? $_GET['search'] : '';
// cek user_id 
$query_user = $conn->prepare("SELECT username, profile_picture FROM user WHERE id = ?");
$query_user->bind_param("i", $user_id);
$query_user->execute();
$result_user = $query_user->get_result();

if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $username = htmlspecialchars($row_user['username']);
    $profile_picture = $row_user['profile_picture'] ?? 'default.png';
    $profile_picture_path = 'uploads/' . $profile_picture;

} else {
    $username = "User Tidak Dikenal";
}
$max_length = 10;
$display_username = strlen($username) > $max_length ? substr($username, 0, $max_length) . '…' : $username;

?>
<!DOCTYPE html>
<html>

<head>
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
    
<nav class="navbar">
<div class="filter-dropdown">
    <button onclick="toggleFilterMenu()" class="filter-toggle">☰</button>
    <div id="filterMenu" class="filter-menu hidden">
    <a href="?<?= http_build_query(['search' => $search]) ?>">Semua</a>
    <a href="?<?= http_build_query(['filter' => 'completed', 'search' => $search]) ?>">Selesai</a>
    <a href="?<?= http_build_query(['filter' => 'late', 'search' => $search]) ?>">Terlambat</a>
    <a href="?<?= http_build_query(['filter' => 'ongoing', 'search' => $search]) ?>">Belum Selesai</a>
    <a href="logout.php">Logout</a>
</div>

</div>

   <div class="profile" onclick="toggleDropdown()">
   <img src="<?= $profile_picture_path ?>" alt="Foto Profil" class="profile-pic">
 <div class="username" title="<?= $username ?>"><?= $display_username ?></div>
    <div class="dropdown-menu hidden" id="dropdownMenu">
        <a href="edit_profile.php">Edit Profile</a>
    </div>
</div>

</nav>

    <h2>ToDo List</h2>

    <a href="add_task.php">Tambah Task</a>
    <br><br>

    <form method="GET">
        <input type="text" name="search" placeholder="Cari task..." value="<?= htmlspecialchars($search) ?>" />
        <button type="submit">Cari</button>
    </form>
    
    <hr>


    <?php
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$sql = "SELECT * FROM todo_list WHERE user_id = ? AND title LIKE ?";
if ($filter === 'completed') {
    $sql .= " AND status = 'completed'";
} elseif ($filter === 'late') {
    $sql .= " AND status != 'completed' AND deadline < CURDATE()";
} elseif ($filter === 'ongoing') {
    $sql .= " AND status != 'completed' AND deadline >= CURDATE()";
}
$sql .= " ORDER BY deadline ASC";

$stmt = $conn->prepare($sql);


    $search_param = "%$search%";
    $stmt->bind_param("is", $user_id, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $status = $row['status'];
            $title = htmlspecialchars($row['title']);
            $deadline = $row['deadline'];

            $icon = ($status === 'completed') ? "✅" : "⬜";
            $label = '';

            if ($status === 'completed') {
                $label = "<span class='done'>(Selesai)</span>";
            } elseif (date('Y-m-d') > $deadline) {
                $label = "<span class='late'>(Terlambat)</span>";
            }

           echo "<div class='task'>
    <div class='task-content '>
    <form method='POST' action='toggle_done.php' style='display:inline'>
    <input type='hidden' name='id' value='$id'>
    <button type='submit'>$icon</button>
    </form>
    <div class='task-text'>
        <strong title='$title'>$title</strong><br>
        <small>Deadline: $deadline $label</small>
    </div>
    </div>
    <div class='task-actions'>
    <a href='edit_task.php?id=$id'>[Edit]</a>
    <a href='delete_task.php?id=$id' onclick=\"return confirm('Hapus task ini?')\">[Hapus]</a>
    </div>
    </div>";

        }
    } else {
        echo "Tidak ada task.";
    }
    ?>
    <script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdownMenu');
    dropdown.classList.toggle('hidden');
}


document.addEventListener('click', function(event) {
    const profile = document.querySelector('.profile');
    const dropdown = document.getElementById('dropdownMenu');

    if (!profile.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});

function toggleFilterMenu() {
    const menu = document.getElementById('filterMenu');
    menu.classList.toggle('hidden');
}

document.addEventListener('click', function(e) {
    const menu = document.getElementById('filterMenu');
    const button = document.querySelector('.filter-toggle');
    if (!menu.contains(e.target) && !button.contains(e.target)) {
        menu.classList.add('hidden');
    }
});
</script>

</body>

</html>