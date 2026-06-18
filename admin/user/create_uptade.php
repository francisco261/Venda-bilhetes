<?php

require_once __DIR__ . '/User.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /public/index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$user = $id ? User::get_by_id($id) : null;
$title = $id ? "Editar" : "Criar";
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <link rel="stylesheet" href="../styles/styles.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Backoffice Tickets</title>
    </head>
    <body>
        <header>
            <div class="header-container">
                <h1>Gestão de Utilizadores </h1>
                <nav>
                    <ul>
                        <li><a href="listall.php">cancelar</a></li>
                        <li><a href="../logout.php">Sair</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <section class="admin-panel">
                <h2><?= $title ?> Utilizador</h2>

                <form action="save_user.php" method="POST" class="game-form">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" name="name" placeholder="Ex: Francisco Branco" value="<?= $user ? $user['name'] : '' ?>" required >
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?= $user ? $user['email'] : '' ?>" required >
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="<?= $user ? $user['password'] : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">Telefone:</label>
                        <input type="text" id="phone" name="phone" placeholder="+35191611456" value="<?= $user ? $user['phone'] : '' ?>" required>
                    </div>
                    <button type="submit" class="btn-submit">Guardar Utilizador</button>
                </form>
            </section>
        </main>
    </body>
</html>