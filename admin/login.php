<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /admin/index.php");
    exit;
}

$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Backoffice</title>
    <link rel="stylesheet" href="styles/login_style.css">
</head>
<body>

<div class="login-box">
    <h1>Backoffice</h1>
    <p>Inicia sessão para continuar</p>

    <?php if ($error): ?>
        <div class="error-msg">Email ou password incorretos.</div>
    <?php endif; ?>

    <form action="login_process.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="dono@email.com" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-login">Entrar</button>
    </form>
</div>

</body>
</html>
