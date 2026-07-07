<?php

require_once "../utils/isConnected.php";
require_once "../utils/quizStarted.php";

// Vérifier que le quiz est bien initialisé
if (!isset($_SESSION['quiz']['question_ids'])) {
    header("Location: ./start-quiz.php");
    exit();
}

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/quiz.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["question_id"]) || !isset($_POST["reponse"])) {
    header("Location: ../public/quiz.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if ((empty($_POST["question_id"]) || empty($_POST["reponse"]))) {
    header("Location: ../public/quiz.php?error=value-empty");
    exit();
}
// Si pas de réponse = timeout = 0 point
if (!isset($_POST["reponse"]) || empty($_POST["reponse"])) {
    $_SESSION['quiz']['last_result'] = 'Temps écoulé !';
    // On saute directement au passage à la question suivante
    $aTimeout = true;
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$question_id = htmlspecialchars(strip_tags(trim($_POST["question_id"])));
$reponseId = htmlspecialchars(strip_tags(trim($_POST["reponse"])));

// ETAPE 2 : METTRE LES DONNEE DU PLAYER EN BDD
require_once "../utils/db_connect.php";

$request = $db->prepare("SELECT * FROM reponse WHERE id = :id");

$request->execute([
    ':id' => $reponseId
]);

$reponse = $request->fetch(PDO::FETCH_ASSOC);

// var_dump($reponse);
// die();

// Vérifier que la réponse existe
if (!$reponse) {
    header("Location: ../public/quiz.php?id=" . $question_id . "&error=answer-not-found");
    exit();
};

// SCORE SESSION
if (!isset($aTimeout)) {
    if ($reponse['est_ce_vrai'] == 1) {
        $_SESSION['quiz']['score']++;
        $_SESSION['quiz']['last_result'] = 'Bonne réponse !';
    } else {
        $_SESSION['quiz']['last_result'] = 'Mauvaise réponse';
    }
}


header("Location: ./next-question.php");
exit();