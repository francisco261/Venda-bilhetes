<?php
// User.php — CRUD completo

require_once __DIR__ . '/../../config/database.php';

class User
{

    // ─────────────────────────────────────────
    // CREATE
    // ─────────────────────────────────────────
    public static function create(string $name, string $email, string $password, string $phone): int
    {
        //self::validar($dados, criar: true);
        $connection = getConn();
        $stmt = $connection->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $password, $phone);
        return $stmt->execute();
    }

    // ─────────────────────────────────────────
    // READ — todos
    // ─────────────────────────────────────────
    public static function list_all(): array
    {
        $connection = getConn();
        $stmt = "SELECT * FROM users";
        return $connection->query($stmt)->fetch_all(MYSQLI_ASSOC);
    }

    // ─────────────────────────────────────────
    // READ — por ID
    // ─────────────────────────────────────────
    public static function get_by_id(int $id): ?array
    {
        $connection = getConn();
        $stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // ─────────────────────────────────────────
    // UPDATE
    // ─────────────────────────────────────────
    public static function update(int $id, string $name, string $email, string $password, string $phone): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("UPDATE users SET name=?, email=?, password=?, phone=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $email, $password, $phone, $id);
        return $stmt->execute();
    }

    // ─────────────────────────────────────────
    // DELETE — permanente
    // ─────────────────────────────────────────
    public static function delete(int $id): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // ─────────────────────────────────────────
    // DELETE — soft delete (desativar)
    // ─────────────────────────────────────────
    public static function active_deactivate(int $id, bool $active): bool
    {
        $connection = getConn();
        $stmt = $connection->prepare("UPDATE users SET active=? WHERE id=?");
        $stmt->bind_param("ii", $active, $id);
        return $stmt->execute();
    }

    public static function get_by_email(string $email): ?array
    {
        $connection = getConn();
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
