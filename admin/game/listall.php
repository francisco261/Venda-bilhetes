<?php
    require_once __DIR__ . '/Game.php';
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /public/index.php");
        exit;
    }
    $games = Game::list_all();


?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <link rel="stylesheet" href="../styles/styles.css">
        <meta charset="UTF-8">
        <title>Jogos</title>
    </head>
    <body>
        <p><a href="../index.php">Menu</a><br/></p>
        <p><a href="../logout.php">Sair</a></p>
        <h1>Lista de jogos</h1>
        <p><a href="create_uptade.php">Criar Jogo</a><br/></p>
        <div class="jogos-lista">
            <?php foreach ($games as $game): ?>
                <div class="jogo-card">
                    <p>ID: <?= $game['id'] ?></p>
                    <p>Nome: <?= $game['team'] ?></p>
                    <p>Data: <?= $game['date'] ?></p>
                    <p>Data: <?= $game['time'] ?></p>
                    <p>Capacidade: <?= $game['capacity'] ?></p>
                    <p>Preço: <?= $game['price'] ?></p>
                    <p>Bilhetes vendidos: <?= $game['sell_tickets'] ?></p>
                    <p>Esgotado: <?= Game::sold_out($game['id']) ? "Esgotado" : "Ainda há bilhetes" ?></p>
                    <p>Ativo: <?= $game['active'] ? "Ativo" : "Inativo" ?></p>
                    <p>Criado em: <?= $game['created_at'] ?></p>
                    <p>Atualizado em: <?= $game['updated_at'] ?></p>
                    <a href="create_uptade.php?id=<?= $game['id'] ?>">Editar jogo</a><br/>
                    <a href="delete_game.php?id=<?= $game['id'] ?>">Apagar jogo</a><br/>
                    <a href="activate_deactivate_game.php?id=<?= $game['id']?>&active=<?= !$game['active']?>">Ativar/Desactivar jogo</a><br/>
                    <a href="bilhetes_vendidos.php?id=<?= $game['id'] ?>">Bilhetes vendidos</a><br/>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>
