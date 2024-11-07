<?php
// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the first and last name from the form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $datum = date("Y-m-d");

    // Store the first and last name in session variables
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['datum'] = $datum;

    // Redirect to the test page or any other page
    header("Location: start_test.php");
    exit();
} else {
    // Define $datum for the form
    $datum = date("Y-m-d");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome!</h1>
            <p class="lead">Willkommen zum Einstufung Test.</p>
            <hr class="my-4">
            <p>Starten Sie den Test indem Sie unten Ihren Namen ausfüllen und auf den Button klicken.</p>
            <form action="includes/validateTeilnehmer.php" method="post">
                <input type="hidden" name="datum" value="<?php echo $datum; ?>"/>
                <div class="form-group">
                    <label for="firstName">Vorname</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
                <div class="form-group">
                    <label for="lastName">Nachname</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
                <button class="btn btn-primary btn-lg" type="submit">Test starten</button>
            </form>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>