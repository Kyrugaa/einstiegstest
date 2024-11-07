<?php 
session_start();
if(!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: index.php");
    exit();
}
require_once 'includes/dbhandler.php';

$conn = getConnection();
$questions = $conn->query("SELECT * FROM questions");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Hello <?php echo htmlspecialchars($_SESSION['firstName']) . ' ' . htmlspecialchars($_SESSION['lastName']); ?></h1>
        <form action="includes/submit_quiz.php" method="post">
            <?php while ($question = $questions->fetch_assoc()): ?>
                <div class="form-group">
                    <label><?php echo htmlspecialchars($question['question']); ?></label>
                    <?php
                    $question_id = $question['id'];
                    $answers = $conn->query("SELECT * FROM answers WHERE question_id = $question_id");
                    while ($answer = $answers->fetch_assoc()): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_<?php echo $question_id; ?>" value="<?php echo $answer['id']; ?>" required>
                            <label class="form-check-label"><?php echo htmlspecialchars($answer['answer']); ?></label>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endwhile; ?>
            <button type="submit" class="btn btn-primary">Test abgeben</button>
        </form>
    </div>
</body>
</html>
<?php close_connection($conn); ?>