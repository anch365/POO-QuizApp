<?php
session_start();
require_once "../utils/isConnected.php";
require_once "../utils/quizStarted.php";
require_once "../utils/db_connect.php";
require_once "../utils/autoloader.php";

$quiz = $_SESSION['quiz'];

// Sécuriser les entrées
$question_id = (int)($_POST['question_id'] ?? 0);
$reponseId = (int)($_POST['reponse'] ?? 0);

// Vérifier la réponse
if ($reponseId === 0) {
    $quiz->timeout();
} else {
    $request = $db->prepare("SELECT est_ce_vrai FROM reponse WHERE id = :id");
    $request->execute([':id' => $reponseId]);
    $reponse = $request->fetch(PDO::FETCH_ASSOC);

    if ($reponse) {
        $quiz->repondre((bool)$reponse['est_ce_vrai']);
    }
}

// Question suivante ?
if ($quiz->next()) {
    $_SESSION['quiz'] = $quiz;
    header("Location: ../public/quiz.php");
} else {
    // Quiz terminé → sauvegarder le score
    $repo = new QuizRepository($db);
    $repo->saveScore($quiz, $_SESSION['user']['id']);
    $_SESSION['quiz'] = $quiz;
    header("Location: ../public/score.php");
}
exit();