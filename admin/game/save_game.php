<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__ . '/Game.php';

    $id = $_POST["id"];
    $team = $_POST["team"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $capacity = $_POST["capacity"];
    $price = $_POST["price"];
    $sell_ticket = $_POST["sell_ticket"];

    if ($id) {
        if (Game::update($id, $team, $date, $time, $capacity, $price, $sell_ticket)) {
            header("Location: /admin/game/listall.php");
        } else {
            echo "<h1>Erro ao editar o Jogo/Evento!!</h1>";
        }
    } else {
        if (Game::create($team, $date, $time, $capacity, $price, $sell_ticket)) {
            header("Location: /admin/game/listall.php");
        } else {
            echo "<h1>Erro ao editar o Jogo/Evento!!</h1>";
        }
    }
?>
