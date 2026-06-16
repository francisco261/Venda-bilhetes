<?php
function getConn() : mysqli
{
    $servername = "db";
    $username = "utilizador";
    $password = "utilizador_password";
    $dbname = "venda_bilhetes";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}