<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Damian Arcipowki, Dawid Lewandowski">
    <title>Schronisko</title>
    <link rel="icon" type="image/x-icon" href="images/paws.ico">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="js/login.js" defer></script>
</head>
<body>
    <div class="login-container">
        <div class="header">
            <h1>🐾 Schronisko</h1>
        </div>
        <div class="form-content">
            <form id="loginForm" method="POST" action="database/login.php">
                <div class="form-group">
                    <label for="username">Login użytkownika</label>
                    <input type="text" id="username" name="username" placeholder="tnowak" required>
                </div>
                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input type="password" id="password" name="password" placeholder="••••" required>
                </div>
                <button type="submit" class="btn-login">Zaloguj</button>
                <div class="extra-info">
                    <a href="#" id="reset-password">Zapomniałeś hasła?</a>
                </div>
            </form>
            <p class="error-field"></p>
        </div>
    </div>
</body>
</html>