<?php 
if (!isset($_SESSION['quiz']) || empty($_SESSION['quiz'])) {
    header("Location: ../process/start-quiz.php");
    exit();
}