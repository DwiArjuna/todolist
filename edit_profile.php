<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/edit_profile.css">
    <meta charset="UTF-8">
</head>
<body>
    <?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil data user
$query = $conn->prepare("SELECT username, profile_picture FROM user WHERE id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

     if (strlen($username) > 10) {
        $error = "Username maksimal 10 karakter!";
    } else 

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $ext = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid() . "." . $ext;
        $upload_path = "uploads/" . $new_name;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
            // Update username + profile_picture
            $stmt = $conn->prepare("UPDATE user SET username = ?, profile_picture = ? WHERE id = ?");
            $stmt->bind_param("ssi", $username, $new_name, $user_id);
        } else {
            echo "Upload gagal!";
            exit;
        }
    } else {
        // Update hanya username (foto tidak diganti)
        $stmt = $conn->prepare("UPDATE user SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $username, $user_id);
    }

   if ($error === "" && isset($stmt)) {
    $stmt->execute();
    header("Location: index.php");
    exit;
} 

}

?>

<h2>Edit Profile</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Username:</label><br>
   <input type="text" name="username" maxlength="10" value="<?= htmlspecialchars($user['username']) ?>" >
    <label>Ganti Foto Profil:</label><br>
    <input type="file" name="profile_picture"><br><br>

    <?php
        $foto = $user['profile_picture'] ? "uploads/" . $user['profile_picture'] : "uploads/default.png";
    ?>
    <img src="<?= $foto ?>" width="100" style="border-radius:50%;">


    <button type="submit">Simpan</button>
</form>

</body>
</html>