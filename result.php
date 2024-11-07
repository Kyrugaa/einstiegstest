<?php
session_start();
if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: index.php");
    exit();
}

$score = isset($_GET['score']) ? $_GET['score'] : 0;
$total_questions = isset($_GET['total']) ? $_GET['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Quiz Results</h1>
        <p>Hello <?php echo htmlspecialchars($_SESSION['firstName']) . ' ' . htmlspecialchars($_SESSION['lastName']); ?>,</p>
        <p>Your score is: <?php echo htmlspecialchars($score) . ' out of ' . htmlspecialchars($total_questions); ?></p>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>