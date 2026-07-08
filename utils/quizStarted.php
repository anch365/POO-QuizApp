<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['quiz']) || empty($_SESSION['quiz'])) {
    header("Location: ../process/start-quiz.php");
    exit();
}