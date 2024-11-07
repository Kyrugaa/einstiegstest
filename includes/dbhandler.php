<?php
function getConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quiz";

    $conn =  mysqli_connect($servername, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function close_connection($conn) {
    try{
        if(isset($conn)) {
            $conn->close();
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        throw $e;
    }
}

function safeTeilnehmer($datum, $firstName, $lastName, $score) {
    try{
        $conn = getConnection();
        $stmt = $conn->prepare("INSERT INTO teilnehmer (datum, firstName, lastName, score) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $datum, $firstName, $lastName, $score);
        return $stmt->execute();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
}

function checkIfCorrect($answer_id) {
    try{
        // Check if the selected answer is correct
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT is_correct FROM answers WHERE id = ?");
        $stmt->bind_param("i", $answer_id);
        $stmt->execute();
        $stmt->bind_result($is_correct);
        $stmt->fetch();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
    return $is_correct;
}

function getTotal() {
    $total_questions = 0;
    try {
        $conn = getConnection();
        $questions = $conn->query("SELECT COUNT(*) as total FROM questions");
        $total_questions = $questions->fetch_assoc()['total'];
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
    return $total_questions;
}


function updateScore($firstName, $lastName, $score) {
    try {
        $conn = getConnection();
        $stmt = $conn->prepare("UPDATE teilnehmer SET score = ? WHERE firstName = ? AND lastName = ?");
        $stmt->bind_param("iss", $score, $firstName, $lastName);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
}