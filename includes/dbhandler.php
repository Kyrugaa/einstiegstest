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


function saveQuestionWithAnswers($question, $answers, $correct_answer) {
    try {
        $conn = getConnection();
        $stmt = $conn->prepare("INSERT INTO questions (question) VALUES (?)");
        $stmt->bind_param("s", $question);
        $stmt->execute();
        $question_id = $stmt->insert_id;

        foreach ($answers as $index => $answer) {
            $is_correct = ($index == $correct_answer) ? 1 : 0;
            $stmt = $conn->prepare("INSERT INTO answers (question_id, answer, is_correct) VALUES (?, ?, ?)");
            $stmt->bind_param("isi", $question_id, $answer, $is_correct);
            $stmt->execute();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
}


function getQuestions() {
    $questions = [];
    try {
        $conn = getConnection();
        $result = $conn->query("SELECT * FROM questions");
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
    return $questions;
}


function getAnswersByQuestionId($question_id) {
    $answers = [];
    try {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT id, answer, is_correct FROM answers WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $answers[] = $row;
        }
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
    return $answers;
}


function updateQuestionWithAnswers($question_id, $question, $answers, $correct_answer) {
    try {
        $conn = getConnection();
        $stmt = $conn->prepare("UPDATE questions SET question = ? WHERE id = ?");
        $stmt->bind_param("si", $question, $question_id);
        $stmt->execute();

        // Fetch existing answers to get their IDs
        $existing_answers = getAnswersByQuestionId($question_id);

        foreach ($answers as $index => $answer) {
            $is_correct = ($index == $correct_answer) ? 1 : 0;
            $answer_id = $existing_answers[$index]['id'];
            $stmt = $conn->prepare("UPDATE answers SET answer = ?, is_correct = ? WHERE id = ?");
            $stmt->bind_param("sii", $answer, $is_correct, $answer_id);
            $stmt->execute();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
}

function getQuestionById($question_id) {
    $question = null;
    try {
        $conn = getConnection();
        $stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $question = $result->fetch_assoc();
        }
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
    return $question;
}


function deleteQuestion($question_id) {
    try {
        $conn = getConnection();

        // Antworte zuerst löschen
        $stmt = $conn->prepare("DELETE FROM answers WHERE question_id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->close();

        // Frage löschen
        $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        close_connection($conn);
    }
}