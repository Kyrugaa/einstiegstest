<?php 
session_start();
require_once 'dbhandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];
    $question = $_POST['question'];
    $answers = $_POST['answers'];
    $correct_answer = $_POST['correct_answer'];

    deleteQuestion($question_id);

    header("Location: ../edit.php");
    exit();
}