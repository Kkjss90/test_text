<?php
require_once 'config.php';
try {
    $pdo = new PDO("pgsql:host=".HOST.";dbname=".DB_NAME, USERNAME, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
