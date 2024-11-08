<?php 
session_start();
require_once 'includes/dbhandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];
    $question = $_POST['question'];
    $answers = $_POST['answers'];
    $correct_answer = $_POST['correct_answer'];

    updateQuestionWithAnswers($question_id, $question, $answers, $correct_answer);

    header("Location: edit.php?success=1");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: edit.php");
    exit();
}

$question_id = $_GET['id'];
$question = getQuestionById($question_id);
$answers = getAnswersByQuestionId($question_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frage bearbeiten</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Frage bearbeiten</h1>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Frage wurde aktualisiert!</div>
        <?php endif; ?>
        <form action="edit_question.php" method="post">
            <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
            <div class="form-group">
                <label for="question">Frage</label>
                <textarea class="form-control" id="question" name="question" required><?php echo htmlspecialchars($question['question']); ?></textarea>
            </div>
            <?php foreach ($answers as $index => $answer): ?>
                <div class="form-group">
                    <label for="answer<?php echo $index + 1; ?>">Antwort <?php echo $index + 1; ?></label>
                    <input type="text" class="form-control" id="answer<?php echo $index + 1; ?>" name="answers[]" value="<?php echo htmlspecialchars($answer['answer']); ?>" required>
                    <input type="radio" name="correct_answer" value="<?php echo $index; ?>" <?php echo $answer['is_correct'] ? 'checked' : ''; ?> required> Richtig
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success">Frage aktualisieren</button>
        </form>
        <a href="edit.php" class="btn btn-primary" style="margin-top: 3em;">Zurück</a>
    </div>
</body>
</html>