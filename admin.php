<?php
session_start();
require_once 'includes/dbhandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $answers = $_POST['answers'];
    $correct_answer = $_POST['correct_answer'];

    saveQuestionWithAnswers($question, $answers, $correct_answer);

    header("Location: admin.php?success=1");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Frage hinzufügen</h1>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Frage wurde hinzugefügt!</div>
        <?php endif; ?>
        <form action="admin.php" method="post">
            <div class="form-group">
                <label for="question">Frage</label>
                <textarea class="form-control" id="question" name="question" required></textarea>
            </div>
            <div class="form-group">
                <label for="answer1">Antwort 1</label>
                <input type="text" class="form-control" id="answer1" name="answers[]" required>
                <input type="radio" name="correct_answer" value="0" required> Richtig
            </div>
            <div class="form-group">
                <label for="answer2">Antwort 2</label>
                <input type="text" class="form-control" id="answer2" name="answers[]" required>
                <input type="radio" name="correct_answer" value="1" required> Richtig
            </div>
            <div class="form-group">
                <label for="answer3">Antwort 3</label>
                <input type="text" class="form-control" id="answer3" name="answers[]" required>
                <input type="radio" name="correct_answer" value="2" required> Richtig
            </div>
            <div class="form-group">
                <label for="answer4">Antwort 4</label>
                <input type="text" class="form-control" id="answer4" name="answers[]" required>
                <input type="radio" name="correct_answer" value="3" required> Richtig
            </div>
            <button type="submit" class="btn btn-primary">Frage speichern</button>
        </form>
    </div>
</body>
</html>