<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Trimatric Medi-Stock</title>
    <link rel="stylesheet" href="Design/loginDesign.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="login-container">
    <div class="logo-section">
        <h1>TRIMATRIC</h1>
        <p>Medi-Stock Manager</p>
    </div>
    <div class="form-section">
        <div class="form-header">
            <h2>Welcome Back</h2>
            <p>Please enter your credentials to login</p>
        </div>
        <form action="../controller/loginController.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
            </div>
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div><br><br>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="footer-links">
            <p><a href="../index.php">Return to Landing Page</a></p>
        </div>
    </div>
</div>
</body>
</html>
