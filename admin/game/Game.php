<?php

require_once __DIR__ . '/../../config/database.php';
class Game
{
    public static function create(string $team, string $date, string $time, int $capacity, float $price, int $sell_tickets): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("INSERT INTO games (team, date, time, capacity, price, sell_tickets) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssidi", $team, $date, $time, $capacity, $price, $sell_tickets);
        return $stmt->execute();
    }

    public static function list_all(): array
    {
        $connection = getConn();
        $stmt = $connection->prepare("SELECT * FROM games");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function get_by_id(int $id): ?array
    {
        $connection = getConn();
        $stmt = $connection->prepare("SELECT * FROM games WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function update(int $id, string $team, string $date, string $time, int $capacity, float $price, int $sell_tickets): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("UPDATE games SET team=?, date=?, time=?, capacity=?, price=?, sell_tickets=? WHERE id=?");
        $stmt->bind_param("sssidii", $team, $date, $time, $capacity, $price, $sell_tickets, $id);
        return $stmt->execute();
    }

    // ─────────────────────────────────────────
    // DELETE — permanente
    // ─────────────────────────────────────────
    public static function delete(int $id): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("DELETE FROM games WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ─────────────────────────────────────────
    // DELETE — soft delete (desativar)
    // ─────────────────────────────────────────
    public static function active_deactivate(int $id, bool $active): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("UPDATE games SET active=? WHERE id=?");
        $stmt->bind_param("ii", $active, $id);
        return $stmt->execute();
    }

    public static function sold_out(int $id): bool {
        $game = Game::get_by_id($id);
        if($game['capacity'] == $game['sell_tickets'])
            return true;
        return false;
    }

    public static function update_sell_tickets(int $id, int $sell_tickets): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("UPDATE games SET sell_tickets=? WHERE id=?");
        $stmt->bind_param("ii",$sell_tickets, $id);
        return $stmt->execute();
    }
}






