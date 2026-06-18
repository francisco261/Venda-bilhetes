<?php
require_once __DIR__ . '/../admin/game/Game.php';

$game_id   = $_GET['id'] ?? null;

if (!$game_id || !is_numeric($game_id)) {
    header("Location: index.php");
    exit;
}

$game = Game::get_by_id($game_id);

if (!$game || !$game['active']) {
    header("Location: index.php");
    exit;
}

$available = $game['capacity'] - $game['sell_tickets'];
$error = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar Bilhete</title>
    <link rel="stylesheet" href="comprar_style.css">
</head>
<body>

<header>
    <div class="header-container">
        <a href="/" class="logo">Sporting <span>Tickets</span></a>
    </div>
</header>

<main>

    <div>
        <a href="index.php" class="back-link">← Voltar aos jogos</a>
        <h2>Comprar Bilhete</h2>

        <?php if ($error): ?>
            <div class="error-msg">Ocorreu um erro ao processar a compra. Tente novamente.</div>
        <?php endif; ?>

        <div class="buy-form">
            <form action="process_ticket.php" method="POST">
                <input type="hidden" name="game_id" value="<?= $game['id'] ?>">
                <div class="form-group">
                    <label for="full_name">Nome completo</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Ex: João Silva" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Ex: joao@email.com" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="tel" id="phone" name="phone" placeholder="Ex: 912 345 678" pattern="[0-9]{9}" required>
                </div>

                <div class="form-group">
                    <label for="tickets">Quantidade de bilhetes</label>
                    <input type="number" id="tickets" name="tickets" min="1" max="<?= $available ?>" value="1" required>
                </div>
                <button type="submit" class="btn-submit">Confirmar Compra</button>
            </form>
        </div>
    </div>


    <div class="game-summary">
        <div class="summary-header">
            <p>Resumo do jogo</p>
            <div class="match">
                Sporting <span>vs</span> <?= $game['team'] ? htmlspecialchars($game['team']) : "" ?>
            </div>
        </div>
        <div class="summary-body">
            <div class="summary-row">
                <span class="label">📅 Data</span>
                <span class="value"><?= $game['date'] ? date('d M Y', strtotime($game['date'])) : '' ?></span>
            </div>
            <div class="summary-row">
                <span class="label">🕐 Hora</span>
                <span class="value"><?= $game['time'] ?></span>
            </div>
            <div class="summary-row">
                <span class="label">🎟 Disponíveis</span>
                <span class="value"><?= $available ?> bilhetes</span>
            </div>
            <div class="summary-row">
                <span class="label">💶 Preço unitário</span>
                <span class="value">€<?= $game['price'] ? number_format($game['price'], 2) : '' ?></span>
            </div>
        </div>
        <div class="summary-footer">
            <span class="total-label">Total</span>
            <span class="total-price" id="total">€<?= $game['price'] ? number_format($game['price'], 2) : '' ?></span>
        </div>
    </div>
</main>

<script>
    const price    = <?= $game['price'] ?>;
    const quantity = document.getElementById('tickets');
    const total    = document.getElementById('total');

    quantity.addEventListener('input', () => {
        const q = parseInt(quantity.value) || 1;
        total.textContent = '€' + (price * q).toFixed(2);
    });
</script>
</body>
</html>
