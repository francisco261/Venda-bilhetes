<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/User.php';

$id = $_GET["id"];
$active = $_GET["active"];

if (User::active_deactivate($id, $active)) {
    header("Location: /admin/user/listall.php");
} else {
    echo "<h1>Erro ao atualizar Utilizador!!</h1>";
}
?>
