<?php
require_once __DIR__ . '/User.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /admin/login.php");
    exit;
}
$users = User::list_all();
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <link rel="stylesheet" href="../styles/styles.css">
        <meta charset="UTF-8">
        <title>Utilizadores</title
    </head>
    <body>
        <p><a href="../index.php">Menu</a><br/></p>
        <p><a href="../logout.php">Sair</a></p>
        <h1>Lista de Utilizadores</h1>
        <p><a href="create_uptade.php">Criar Novo Utilizador</a><br/></p>
        <div class="jogos-lista">
            <?php foreach ($users as $user): ?>
                <div class="jogo-card">
                    <p>ID: <?= $user['id'] ?></p>
                    <p>Nome: <?= $user['name'] ?></p>
                    <p>Email: <?= $user['email'] ?></p>
                    <p>Telefone: <?= $user['phone'] ?></p>
                    <p>Ativo: <?= $user['active'] ?></p>
                    <p>Criado em: <?= $user['created_at'] ?></p>
                    <p>Atualizado em: <?= $user['updated_at'] ?></p>
                    <a href="create_uptade.php?id=<?= $user['id'] ?>">Editar Utilizador</a><br/>
                    <a href="delete_user.php?id=<?= $user['id'] ?>">Apagar Utilizador</a><br/>
                    <a href="activate_deactivate_user.php?id=<?= $user['id']?>&active=<?= !$user['active']?>">Ativar/Desactivar Utilizador</a>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
