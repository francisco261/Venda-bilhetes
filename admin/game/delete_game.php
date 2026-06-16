<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__ . '/Game.php';

    // read POST data
    $id = $_GET["id"];

    if (Game::delete($id)) {
        header("Location: /admin/game/listall.php");
    } else {
        echo "<h1>Erro ao apagar Jogo!!</h1>";
    }
