<?php
session_start();

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Quiz.php');

$quiz = new MyApp\Quiz();
$correctAnswer = $quiz->checkAnswer(); //Quiz.phpのメソッドに投げる

header('Content-Type: application/json; charset=UTF-8');
echo json_encode([
    'correct_answer' => $correctAnswer
]);
