<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Flixio</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
</head>


<body>

<div class="header">
    <div class="logo">
        <span class="flix">Flix</span><span class="io">io</span>
    </div>
</div>

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>

        <form action="../auth/login_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>

        <div class="footer">
            © 2026 Flixio
        </div>
    </div>
</div>

</body>
</html>