<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Login.css">
    <title>Login</title>
  
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="" required>
                <label for="email" class="email">Email</label>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="form-group">
            <p>Belum Punya Akun? <a href="Register.php">Register</a></p>
        </div>
    </div>

    
</body>
</html>
