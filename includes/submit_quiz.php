<?php
session_start();
require_once 'dbhandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = getConnection();
    $score = 0;

    // Ermitteln der Gesamtzahl der Fragen
    $total_questions = getTotal();

    // Loop through each submitted answer
    foreach ($_POST as $key => $answer_id) {
        if (strpos($key, 'question_') === 0) {
            // Get the question ID from the key
            $question_id = str_replace('question_', '', $key);

            // Check if the selected answer is correct
            $is_correct = checkIfCorrect($answer_id);

            if ($is_correct) {
                $score++;
            }
        }
    }

    // Update the score in the database
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    updateScore($firstName, $lastName, $score);

    // Redirect to the results page with score and total questions
    header("Location: ../result.php?score=$score&total=$total_questions");
    exit();
}
?>