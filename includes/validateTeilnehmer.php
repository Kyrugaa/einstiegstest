<?php
session_start();

require_once 'dbhandler.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $datum = date("Y-m-d");
    $score = 0;

    if(empty($firstName) || empty($lastName)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    if(safeTeilnehmer($datum, $firstName, $lastName, $score)) {
        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        header("Location: ../quiz.php");
        exit();
    } else {
        header("Location: ../index.php?error=database");
        exit();
    }
}