<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Damian Arcipowki, Dawid Lewandowski">
    <title>Schronisko</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
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
                    <a href="#" onclick="alert('Skontaktuj się z administratorem'); return false;">Zapomniałeś hasła?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>