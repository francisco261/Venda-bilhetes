<?php
require_once __DIR__ . '/../admin/game/Game.php';
$games = Game::list_all();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogos & Bilhetes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <div class="header-container">
        <a href="../admin/login.php" class="logo">Sporting <span>Tickets</span></a>
    </div>
</header>

<div class="hero">
    <h1>Próximos Jogos</h1>
    <p>Compra o teu bilhete e não percas nenhum jogo</p>
</div>

<main>
    <p class="section-title"><?= count($games) ?> jogos disponíveis</p>

    <?php if (empty($games)): ?>
        <div class="empty">
            <p>Não há jogos disponíveis de momento.</p>
        </div>
    <?php else: ?>
        <div class="games-grid">
            <?php foreach ($games as $game):
                if (!$game['active']) continue;

                $sold      = $game['sell_tickets'];
                $capacity  = $game['capacity'];
                $percent   = $capacity > 0 ? round(($sold / $capacity) * 100) : 0;
                $available = $capacity - $sold;
                $soldOut   = $available <= 0;
                $almostFull = $percent >= 80 && !$soldOut;
                $badgeText  = $soldOut ? 'Esgotado' : ($almostFull ? 'Últimos bilhetes' : 'Disponível');
                ?>

                <div class="game-card">
                    <div class="card-header">
                        <div class="match">
                            Sporting <span>vs</span> <?= $game['team']  ?>
                        </div>
                        <div class="card-meta">
                            <span>📅 <?= $game['date']?></span>
                            <span>🕐 <?= $game['time'] ?></span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="availability">
                            <div class="availability-label">
                                <span>Bilhetes disponíveis</span>
                                <span><?= $available ?> / <?= $capacity ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="price">
                            €<?= $game['price'] ? number_format($game['price'], 2) : '' ?>
                            <span>/ bilhete</span>
                        </div>

                        <?php if ($soldOut): ?>
                            <span class="btn-sold-out">Esgotado</span>
                        <?php else: ?>
                            <a href="comprar.php?id=<?= $game['id'] ?>" class="btn-buy">Comprar</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

</body>
</html>
