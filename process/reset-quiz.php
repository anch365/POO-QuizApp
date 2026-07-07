<?php 
require_once "../utils/isConnected.php";

session_start();
require_once "../utils/quizStarted.php";

// Vider la session = recommencer un nouveau quiz
unset($_SESSION['quiz']);

header("Location: ./start-quiz.php");

?>