<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar conta</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <h1>Criar conta</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="login.php">Login</a>
            <a href="eventos.php">Eventos</a>
        </nav>
    </header>

    <main>
        <?php if (($_GET['erro'] ?? '') === 'username'): ?>
            <p class="alert">Esse username ja existe. Escolhe outro.</p>
        <?php elseif (($_GET['erro'] ?? '') === 'campos'): ?>
            <p class="alert">Preenche todos os campos.</p>
        <?php endif; ?>

        <form action="scripts/registar.php" method="post">
            <label>
                Nome
                <input type="text" name="nome" required placeholder="Tomas">
            </label>
            <label>
                Username
                <input type="text" name="username" required placeholder="tomas">
            </label>
            <label>
                Password
                <input type="password" name="password" required>
            </label>
            <button type="submit">Criar conta</button>
        </form>
     </main>
</body>
</html>