<?php
require_once 'db.php';

header('Content-Type: application/json; charset=utf-8');

function detectLanguage($text) {
    $cyrillicCount = preg_match_all('/[а-яА-Я]/u', $text);
    $latinCount = preg_match_all('/[a-zA-Z]/', $text);
    return ($cyrillicCount >= $latinCount) ? 'ru' : 'en';
}

function highlightMismatchedChars($text, $language) {
    $pattern = ($language === 'ru') ? '/[a-zA-Z]/' : '/[а-яА-Я]/u';
    return preg_replace_callback($pattern, function($matches) {
        return '<span class="highlight">' . $matches[0] . '</span>';
    }, $text);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode(['error' => 'Ошибка декодирования JSON']));
    }

    $text = $data['text'];
    if (empty($text)) {
        die(json_encode(['error' => 'Текст не был передан']));
    }

    $language = detectLanguage($text);
    $highlightedText = highlightMismatchedChars($text, $language);

    if (empty($data['isAutoCheck'])) {
        $stmt = $pdo->prepare('INSERT INTO history (text, language) VALUES (?, ?)');
        $stmt->execute([$text, $language]);
    }

    echo json_encode([
        'highlightedText' => $highlightedText,
        'language' => $language
    ]);
}
?>