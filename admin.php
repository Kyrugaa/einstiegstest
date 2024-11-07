<?php
session_start();
require_once 'includes/dbhandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $answers = $_POST['answers'];
    $correct_answer = $_POST['correct_answer'];

    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO questions (question) VALUES (?)");
    $stmt->bind_param("s", $question);
    $stmt->execute();
    $question_id = $stmt->insert_id;

    foreach ($answers as $index => $answer) {
        $is_correct = ($index == $correct_answer) ? 1 : 0;
        $stmt = $conn->prepare("INSERT INTO answers (question_id, answer, is_correct) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $question_id, $answer, $is_correct);
        $stmt->execute();
    }

    close_connection($conn);
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
        <h1>Add Question</h1>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Question added successfully!</div>
        <?php endif; ?>
        <form action="admin.php" method="post">
            <div class="form-group">
                <label for="question">Question</label>
                <textarea class="form-control" id="question" name="question" required></textarea>
            </div>
            <div class="form-group">
                <label for="answer1">Answer 1</label>
                <input type="text" class="form-control" id="answer1" name="answers[]" required>
                <input type="radio" name="correct_answer" value="0" required> Correct
            </div>
            <div class="form-group">
                <label for="answer2">Answer 2</label>
                <input type="text" class="form-control" id="answer2" name="answers[]" required>
                <input type="radio" name="correct_answer" value="1" required> Correct
            </div>
            <div class="form-group">
                <label for="answer3">Answer 3</label>
                <input type="text" class="form-control" id="answer3" name="answers[]" required>
                <input type="radio" name="correct_answer" value="2" required> Correct
            </div>
            <div class="form-group">
                <label for="answer4">Answer 4</label>
                <input type="text" class="form-control" id="answer4" name="answers[]" required>
                <input type="radio" name="correct_answer" value="3" required> Correct
            </div>
            <button type="submit" class="btn btn-primary">Save Question</button>
        </form>
    </div>
</body>
</html>