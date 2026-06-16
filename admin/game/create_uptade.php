<?php
    require_once __DIR__ . '/Game.php';

    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login.php");
        exit;
    }

    $id = $_GET['id'] ?? null;
    $game = $id ? Game::get_by_id($id) : null;
    $title = $id ? "Editar" : "Criar";
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/styles.css">
        <title>Backoffice Tickets</title>
    </head>
    <body>
        <header>
            <div class="header-container">
                <h1>Gestão de Jogos </h1>
                <nav>
                    <ul>
                        <li><a href="listall.php">Cancelar</a></li>
                        <li><a href="../logout.php">Sair</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <section class="admin-panel">
                <h2><?= $title ?> Jogo</h2>

                <form action="save_game.php" method="POST" class="game-form">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="team">Equipa Adversária:</label>
                        <input type="text" id="team" name="team" value="<?= $game ? $game['team'] : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="date">Data do Jogo:</label>
                        <input type="date" id="date" name="date" value="<?= $game ? $game['date'] : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="time">Hora:</label>
                        <input type="time" id="time" name="time" value="<?= $game ? $game['time'] : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="capacity">Lotação Total (Nº de Bilhetes):</label>
                        <input type="number" id="capacity" name="capacity" value="<?= $game ? $game['capacity'] : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Preço Base (€):</label>
                        <input type="number" id="price" name="price" value="<?= $game ? $game['price'] : ''  ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="sell_tickets"> Bilhetes vendidos:</label>
                        <input type="number" id="sell_tickets" name="sell_ticket" value="<?= $game ? $game['sell_tickets'] : 0 ?>">
                    </div>
                    <button type="submit" class="btn-submit">Guardar jogo </button>
                </form>
            </section>
        </main>
    </body>
</html>



