<?php
declare(strict_types=1);

function getDatabase(): PDO
{
    $databaseDir = __DIR__ . '/../data';

    if (!is_dir($databaseDir)) {
        mkdir($databaseDir, 0775, true);
    }

    $pdo = new PDO('sqlite:' . $databaseDir . '/bilhetes_clube.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
}

function initializeDatabase(): void
{
    $db = getDatabase();

    $db->exec(
        'CREATE TABLE IF NOT EXISTS utilizadores (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            username TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            tipo TEXT NOT NULL,
            ultimo_acesso TEXT
        )'
    );
}
?>