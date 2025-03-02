<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Проверка текста</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Проверка текста на несоответствующие символы</h1>
    <form id="form">
        <textarea id="input" rows="6" placeholder="Введите текст..."></textarea>
        <button type="button" onclick="checkText()">Проверить</button>
    </form>
    <div id="result"></div>
    <h2>История проверок</h2>
    <div id="history"></div>
</div>
<script src="script.js"></script>
</body>
</html>