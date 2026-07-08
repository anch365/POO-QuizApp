<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: ../public/login.php");
    exit();
}