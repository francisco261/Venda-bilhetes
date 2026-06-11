<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

initializeDatabase();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../criar_conta.html');
    exit;
}

$name = trim($_POST['nome'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $username === '' || $password === '') {
    header('Location: ../criar_conta.html?erro=campos');
    exit;
}

$db = getDatabase();
$exists = $db->prepare('SELECT COUNT(*) FROM utilizadores WHERE username = :username');
$exists->execute([':username' => $username]);

if ((int) $exists->fetchColumn() > 0) {
    header('Location: ../criar_conta.html?erro=username');
    exit;
}

$insert = $db->prepare(
    'INSERT INTO utilizadores (nome, username, password_hash, tipo)
     VALUES (:nome, :username, :password_hash, :tipo)'
);
$insert->execute([
    ':nome' => $name,
    ':username' => $username,
    ':password_hash' => password_hash($password, PASSWORD_DEFAULT),
    ':tipo' => 'adepto',
]);

header('Location: ../index.html?registo=ok');
exit;
?>
