<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/User.php';

$id = $_POST["id"];
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["phone"];

if ($id) {
    if (User::update($id, $name, $email, $password, $phone)) {
        header("Location: /admin/user/listall.php");
    } else {
        echo "<h1>Erro ao editar utilizador</h1>";
    }
} else {
    if (User::create($name, $email, $password, $phone)) {
        header("Location: /admin/user/listall.php");
    } else {
        echo "<h1>Erro ao editar o Jogo/Evento!!</h1>";
    }
}
?>
