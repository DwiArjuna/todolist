<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Register.css">
    <title>Register</title>
  
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="Register_process.php" method="POST">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="" required>
                <label for="email">Email</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="" required>
                <label for="password">Password</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="confirm_password" placeholder="" required>
                <label for="password">Confirm Password</label>
            </div>
            <button type="submit" class="login-btn">Register</button>
            <div class="form-group">
                <p>Sudah Punya Akun? <a href="Login.php">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>