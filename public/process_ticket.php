<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../admin/game/Game.php';
require_once __DIR__ . '/Client.php';

$game_id = $_POST["game_id"];

$game = Game::get_by_id($game_id);

$full_name = $_POST["full_name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$tickets = $_POST["tickets"];
$total = $tickets * $game['price']; ;
$sell_tickets = $tickets + $game['sell_tickets'];

if(!Client::save_buy($game_id, $full_name, $email, $phone, $tickets, $total)){
    echo "<h1>Erro ao comprar!!</h1>";
}
if(!Game::update_sell_tickets($game_id, $sell_tickets)) {
    echo "<h1>Erro ao atualizar jogo!!</h1>";
}
header("Location: /public/index.php");
