<?php
require_once __DIR__ . '/Game.php';
require_once __DIR__ . '/../../public/Client.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("/public/index.php");
    exit;
}

$game_id = $_GET['id'] ?? null;

if (!$game_id || !is_numeric($game_id)) {
    header("Location: ../game/listall.php");
    exit;
}

$game    = Game::get_by_id($game_id);
$tickets = Client::get_by_game($game_id);

if (!$game) {
    header("Location: /admin/game/listall.php");
    exit;
}

$total_tickets = $game['sell_tickets'];

$total_revenue = 0;
foreach ($tickets as $ticket) {
    $total_revenue = $total_revenue + $ticket['total'];
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilhetes — <?= htmlspecialchars($game['team']) ?></title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>

<header>
    <div class="header-container">
        <h1>Gestão de Bilheteira</h1>
        <nav>
            <ul>
                <li><a href="listall.php">Início</a></li>
                <li><a href="../logout.php">Sair</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <div class="page-header">
        <h2>Sporting vs <?= htmlspecialchars($game['team']) ?></h2>
        <p>📅 <?= date('d M Y', strtotime($game['date'])) ?> &nbsp;·&nbsp; 🕐 <?= $game['time'] ?></p>
    </div>

    <!-- Estatísticas -->
    <div class="stats">
        <div class="stat-card">
            <div class="stat-label">Bilhetes vendidos</div>
            <div class="stat-value blue"><?= $total_tickets ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Receita total</div>
            <div class="stat-value green">€<?= number_format($total_revenue, 2) ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Lotação</div>
            <div class="stat-value"><?= $game['capacity'] ?></div>
        </div>
    </div>

    <div class="table-wrapper">
        <?php if (empty($tickets)): ?>
            <div class="empty">Ainda não há bilhetes vendidos para este jogo.</div>
        <?php else: ?>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Bilhetes</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td class="td-muted"><?= $ticket['id'] ?></td>
                        <td><?= htmlspecialchars($ticket['full_name']) ?></td>
                        <td class="td-muted"><?= htmlspecialchars($ticket['email']) ?></td>
                        <td class="td-muted"><?= htmlspecialchars($ticket['phone']) ?></td>
                        <td><span class="badge-tickets"><?= $ticket['tickets'] ?></span></td>
                        <td class="total-value"><?= number_format($ticket['total'], 2) ?>€</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

</body>
</html>