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
            <a href="add_question.php" class="btn btn-primary" style="margin-bottom: 1em; margin-top: 2em;">Fragen hinzufügen</a>
            <tbody>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($question['question']); ?></td>
                        <td>
                            <a href="edit_question.php?id=<?php echo $question['id']; ?>" class="btn btn-secondary">Bearbeiten</a>
                            <form action="includes/delete_question.php" method="POST" style="display:inline;">
                                <input type="hidden" name="question_id" value="<?php echo $question['id']; ?>">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sind Sie sicher, dass Sie diese Frage löschen möchten?');">Löschen</button>
                            </form>                        
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>