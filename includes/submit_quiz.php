<?php
session_start();
require_once 'dbhandler.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;
    $total_questions = getTotal();
    foreach ($_POST as $key => $answer_id) {
        if (strpos($key, 'question_') === 0) {
            $question_id = str_replace('question_', '', $key);
            $is_correct = checkIfCorrect($answer_id);
            if ($is_correct) {
                $score++;
            }
        }
    }
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    updateScore($firstName, $lastName, $score);
    $_SESSION['score'] = $score;
    $_SESSION['total_questions'] = $total_questions; // Setze die Gesamtzahl der Fragen in der Session
    header("Location: ../result.php");
    exit();
}