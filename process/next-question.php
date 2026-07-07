<?php
require_once "../utils/isConnected.php";
require_once "../utils/quizStarted.php";


// Passer à la question suivante
$_SESSION['quiz']['current_index']++;

// Y a-t-il encore une question ?
if ($_SESSION['quiz']['current_index'] < count($_SESSION['quiz']['question_ids'])) {

    // Oui → rediriger vers la question suivante
    $nextId = $_SESSION['quiz']['question_ids'][$_SESSION['quiz']['current_index']];
    $_SESSION['quiz']['question_id'] = $nextId;

    header("Location: ../public/quiz.php");
    exit();
} else {
    // Non → quiz terminé
    header("Location: ../public/score.php");
    exit();
}
