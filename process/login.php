<?php
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: ../public/login.php?error=bad-method");
    exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["mail"]) || !isset($_POST["motdepasse"])) {
    header("Location: ../public/login.php?error=missing-value");
    exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_POST["mail"]) || empty($_POST["motdepasse"])) {
    header("Location: ../public/login.php?error=empty-value");
    exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$mail = htmlspecialchars(strip_tags(trim($_POST["mail"])));
$motdepasse = htmlspecialchars(strip_tags(trim($_POST["motdepasse"])));


// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once "../utils/db_connect.php";

$request = $db->prepare("SELECT * FROM utilisateur WHERE email = :mail");

$request->execute([
    ':mail' => $mail
]);

$user = $request->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: ../public/login.php?error=bad-credentials");
    exit();
}

if (!password_verify($motdepasse, $user['mot_de_passe'])) {
    header("Location: ../public/login.php?error=bad-credentials");
    exit();
}

// Démarrer la session
session_start();

// Stocker l'utilisateur EN SESSION (sans le mot de passe !)
$_SESSION['user'] = [
    'id' => $user['id'],
    'pseudo' => $user['pseudo'],
    'email' => $user['email']
];

// if (!password_verify($motdepasse, $passwordHashe)) {
//   # code...
// }
// // 
// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ./start-quiz.php");
exit();
