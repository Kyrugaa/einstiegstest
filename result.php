<?php
session_start();
if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    header("Location: index.php");
    exit();
}

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$total_questions = isset($_SESSION['total']) ? $_SESSION['total'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Resultat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Quiz Resultat</h1>
        <p>Hallo <?php echo htmlspecialchars($_SESSION['firstName']) . ' ' . htmlspecialchars($_SESSION['lastName']); ?>,</p>
        <p>Dein Score ist: <?php echo htmlspecialchars($score) . ' von ' . htmlspecialchars($total_questions); ?></p>
        <a href="index.php" class="btn btn-primary">Zurück zur Startseite</a>
    </div>
</body>
</html>