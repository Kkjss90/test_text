<?php
require_once 'db.php';

$stmt = $pdo->query('SELECT text, language, created_at FROM history ORDER BY created_at DESC');
$history = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($history);
?>