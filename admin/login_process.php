<?php
session_start();

require_once __DIR__ . '/user/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$user = User::get_by_email($email);

if ($user && $password == $user['password']) {

    $_SESSION['user_id']   = $user['id'];

    header("Location: /admin/index.php");
} else {
    // credenciais erradas
    //header("Location: login.php?error=1");
}
exit;
