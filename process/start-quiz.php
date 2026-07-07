<?php
session_start();
require_once "../utils/db_connect.php";
require_once "../utils/autoloader.php";

$repo = new QuizRepository($db);
$quiz = $repo->startQuiz();

$_SESSION['quiz'] = $quiz;

header("Location: ../public/quiz.php");
exit();