<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Todo List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        nav.navbar {
            width: 100%;
            max-width: 640px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px 16px;
            display: flex;
            justify-content: flex-end;
            position: relative;
            user-select: none;
        }
        .profile {
            display: flex;
            align-items: center;
            cursor: pointer;
            position: relative;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid #ccc;
            margin-right: 8px;
        }
        .profile span {
            font-weight: 600;
            color: #333;
        }
        .profile .caret {
            margin-left: 6px;
            border-top: 5px solid #555;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            width: 0;
            height: 0;
        }
        /* Dropdown menu */
        #profile-menu {
            display: none;
            position: absolute;
            top: 56px;
            right: 16px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 160px;
            z-index: 10;
        }
        #profile-menu a {
            display: block;
            padding: 10px 16px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            border-bottom: 1px solid #eee;
        }
        #profile-menu a:last-child {
            border-bottom: none;
        }
        #profile-menu a:hover {
            background-color: #f0f0f0;
        }

        main {
            width: 100%;
            max-width: 640px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 24px 32px;
            margin-top: 24px;
        }
        h2 {
            margin-top: 0;
            margin-bottom: 16px;
            font-size: 24px;
            color: #222;
        }
        a.button-add {
            display: inline-block;
            background-color: #2563eb;
            color: white;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 24px;
            transition: background-color 0.2s ease;
        }
        a.button-add:hover {
            background-color: #1e40af;
        }
        form.search-form {
            display: flex;
            margin-bottom: 24px;
        }
        form.search-form input[type="text"] {
            flex-grow: 1;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px 0 0 6px;
            font-size: 16px;
            outline: none;
        }
        form.search-form button {
            background-color: #2563eb;
            border: none;
            color: white;
            padding: 0 16px;
            font-size: 16px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }
        form.search-form button:hover {
            background-color: #1e40af;
        }
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin-bottom: 24px;
        }
        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 16px;
            background-color: #fafafa;
            transition: box-shadow 0.2s ease;
        }
        .task:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .task-content {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            max-width: 75%;
        }
        .task-content form {
            margin: 0;
        }
        .task-content button {
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            line-height: 1;
            user-select: none;
        }
        .task-content strong {
            font-weight: 700;
            color: #222;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 200px;
        }
        .task-content span.deadline {
            color: #555;
            font-size: 14px;
            white-space: nowrap;
        }
        .done {
            color: #16a34a;
            font-weight: 600;
            margin-left: 6px;
            font-size: 14px;
        }
        .late {
            color: #dc2626;
            font-weight: 600;
            margin-left: 6px;
            font-size: 14px;
        }
        .task-actions a {
            margin-left: 12px;
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
            cursor: pointer;
            user-select: none;
        }
        .task-actions a:hover {
            text-decoration: underline;
        }
        .no-tasks {
            color: #666;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 480px) {
            nav.navbar {
                justify-content: center;
            }
            main {
                padding: 16px 20px;
            }
            .task-content strong {
                max-width: 120px;
            }
            .task-content span.deadline {
                font-size: 12px;
            }
            .task-actions a {
                margin-left: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<div style='color:#dc2626; font-weight:bold; margin-bottom:16px;'>Kamu harus login dulu.</div>";
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
    $profile_picture = 'uploads/' . ($row_user['profile_picture'] ?? 'default.png');
} else {
    $username = "User Tidak Dikenal";
}
?>

<nav class="navbar">
    <div class="profile" id="profile" tabindex="0" aria-haspopup="true" aria-expanded="false" aria-controls="profile-menu" onclick="toggleMenu()" onkeydown="if(event.key==='Enter' || event.key===' ') { event.preventDefault(); toggleMenu(); }" role="button" aria-label="User profile menu">
        <img src="<?= $profile_picture ?>" alt="Foto profil pengguna <?= $username ?> dengan latar belakang netral" class="profile-pic" />
        <span><?= $username ?></span>
        <span class="caret"></span>
    </div>
    <div id="profile-menu" role="menu" aria-orientation="vertical" aria-labelledby="profile" >
        <a href="edit_profile.php" role="menuitem"><i class="fas fa-user-edit" style="margin-right:6px;"></i>Edit Profile</a>
        <a href="logout.php" role="menuitem"><i class="fas fa-sign-out-alt" style="margin-right:6px;"></i>Logout</a>
    </div>
</nav>

<main>
    <h2>ToDo List</h2>

    <a href="add_task.php" class="button-add"><i class="fas fa-plus" style="margin-right:6px;"></i>Tambah Task</a>

    <form method="GET" class="search-form" onsubmit="return true;">
        <input type="text" name="search" placeholder="Cari task..." value="<?= htmlspecialchars($search) ?>" />
        <button type="submit" aria-label="Cari task"><i class="fas fa-search"></i></button>
    </form>

    <hr />

    <?php
    $stmt = $conn->prepare("SELECT * FROM todo_list WHERE user_id = ? AND title LIKE ? ORDER BY deadline ASC");
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
                <div class='task-content'>
                    <form method='POST' action='toggle_done.php' style='display:inline; margin:0; padding:0;'>
                        <input type='hidden' name='id' value='$id' />
                        <button type='submit' aria-label='Toggle status task $title' style='font-size:20px; background:none; border:none; cursor:pointer; padding:0; user-select:none;'>$icon</button>
                    </form>
                    <strong title='$title'>$title</strong>
                    <span class='deadline'>Deadline: $deadline</span>
                    $label
                </div>
                <div class='task-actions'>
                    <a href='edit_task.php?id=$id' aria-label='Edit task $title'>[Edit]</a>
                    <a href='delete_task.php?id=$id' onclick=\"return confirm('Hapus task ini?')\" aria-label='Hapus task $title'>[Hapus]</a>
                </div>
            </div>";
        }
    } else {
        echo "<p class='no-tasks'>Tidak ada task.</p>";
    }
    ?>
</main>

<script>
    // Minimal JS only for dropdown toggle
    function toggleMenu() {
        var menu = document.getElementById('profile-menu');
        if (menu.style.display === 'block') {
            menu.style.display = 'none';
            document.getElementById('profile').setAttribute('aria-expanded', 'false');
        } else {
            menu.style.display = 'block';
            document.getElementById('profile').setAttribute('aria-expanded', 'true');
        }
    }
    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        var profile = document.getElementById('profile');
        var menu = document.getElementById('profile-menu');
        if (!profile.contains(event.target) && !menu.contains(event.target)) {
            menu.style.display = 'none';
            profile.setAttribute('aria-expanded', 'false');
        }
    });
</script>
</body>
</html>