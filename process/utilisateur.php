<?php
// ETAPE 1 : FAIRE LA SECURITE

// Première étape de sécurité : verifier la méthode
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
  header("Location: ../public/utilisateur.php?error=bad-method");
  exit();
}

// Deuxieme étape de sécurité : verifier que la colonne voulue existe bien
if (!isset($_POST["pseudo"]) || !isset($_POST["mail"]) || !isset($_POST["motdepasse"])) {
  header("Location: ../public/utilisateur.php?error=missing-value");
  exit();
}

// Troisième étape de sécurité : verifier que la colonne voulue n'est pas vide
if (empty($_POST["pseudo"]) || empty($_POST["mail"]) || empty($_POST["motdepasse"])) {
  header("Location: ../public/utilisateur.php?error=empty-value");
  exit();
}

// Quatrième étape de sécurité : on empêche l'utilisation de balise (par exemple script)
$pseudo = htmlspecialchars(strip_tags(trim($_POST["pseudo"])));
$mail = htmlspecialchars(strip_tags(trim($_POST["mail"])));
$motdepasse = htmlspecialchars(strip_tags(trim($_POST["motdepasse"])));


// ETAPE 2 : METTRE LES DONNEE DU PATIENT EN BDD (PDO traduit php pour pouvoir communiquer avec la BDD)
require_once "../utils/db_connect.php";

$request = $db->prepare("INSERT INTO quiz_app.utilisateur
(pseudo, email, mot_de_passe) 
VALUES(:pseudo, :email, :mot_de_passe)");

$request->execute([
  ':pseudo' => $pseudo,
  ':email' => $mail,
  ':mot_de_passe' => password_hash($motdepasse, PASSWORD_DEFAULT)
]);

// if (!password_verify($motdepasse, $passwordHashe)) {
//   # code...
// }
// // 
// ETAPE 3 : REDIRIGER SUR UNE PAGE D'AFFICHAGE
header("Location: ../public/quiz.php");
exit();
