<?php
require_once "../utils/autoloader.php";
require_once "../utils/isConnected.php";
require_once "../utils/quizStarted.php";

$quiz = $_SESSION['quiz'];

// Le timeout = pas de réponse = 0 point
$quiz->timeout();

// Passer à la question suivante
if ($quiz->next()) {
    $_SESSION['quiz'] = $quiz;
    header("Location: ../public/quiz.php");
} else {
    $_SESSION['quiz'] = $quiz;
    header("Location: ../public/score.php");
}
exit();