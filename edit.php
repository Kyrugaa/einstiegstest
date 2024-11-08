<?php 
session_start();
require_once 'includes/dbhandler.php';

$questions = getQuestions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Questions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Fragen bearbeiten/löschen</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Frage</th>
                    <th>Aktionen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($question['question']); ?></td>
                        <td>
                            <a href="edit_question.php?id=<?php echo $question['id']; ?>" class="btn btn-secondary">Bearbeiten</a>
                            <a href="delete_question.php?id=<?php echo $question['id']; ?>" class="btn btn-danger" onclick="return confirm('Sind Sie sicher, dass Sie diese Frage löschen möchten?');">Löschen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>