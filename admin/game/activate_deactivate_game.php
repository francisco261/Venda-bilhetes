<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__ . '/Game.php';

    $id = $_GET["id"];
    $active = $_GET["active"];

    if (Game::active_deactivate($id, $active)) {
        header("Location: /admin/game/listall.php");
    } else {
        echo "<h1>Erro ao alterar estado do Jogo!!</h1>";
    }