<?php
require_once __DIR__ . '/../config/database.php';
class Client
{
    public static function save_buy(int $game_id, string $full_name, string $email, string $phone, int $tickets, float $total): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("INSERT INTO clients (game_id, full_name, email, phone, tickets, total) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssid", $game_id, $full_name, $email, $phone, $tickets, $total);
        return $stmt->execute();
    }

    public static function get_by_game(int $game_id): ?array
    {
        $connection = getConn();
        $stmt = $connection->prepare("SELECT * FROM clients WHERE game_id = ?");
        $stmt->bind_param("s", $game_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
