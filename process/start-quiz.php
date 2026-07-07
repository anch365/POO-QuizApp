<?php
session_start();
require_once "../utils/db_connect.php";

// Récupérer tous les IDs des questions dans un ordre aléatoire
$request = $db->prepare("SELECT id FROM questionnement ORDER BY RAND()");
$request->execute();
$questionIds = $request->fetchAll(PDO::FETCH_COLUMN);

// Stocker en session
$_SESSION['quiz'] = [
    'score' => 0,
    'start_time' => time(),
    'question_ids' => $questionIds,   // Tableau d'IDs mélangés
    'current_index' => 0              // On commence au premier
];

header("Location: ../public/quiz.php");
exit();