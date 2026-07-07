<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizApp</title>
    <!-- POLICE D'ECRITURE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gayathri:wght@100;400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/styles/output.css">
    <script src="../assets/scripts/main.js" defer></script>
</head>

<body class="max-h-screen flex flex-col gap-8 pt-32 px-8 gayathri items-center text-center md:px-24 ">
    <header class="flex flex-row fixed top-0 right-0 left-0 bg-mauve-btn justify-between px-8">
        <a href="../public/index.php"><img src="../assets/imgs/logo-QuizApp.png" alt="Logo du QuizApp" class="w-14 h-14 my-1 rounded-full"></a>

        <!-- MENU burger -->
        <img src="../assets/imgs/menu.png" alt="Menu burger pour les options" class="h-16 lg:hidden" id="menuburger">

        <div
            id="fond-sombre"
            class="fixed top-0 right-0 left-0 bottom-0 bg-black/30 hidden lg:hidden">
        </div>
        <!-- Fenêtre du menu mobile -->
        <div
            id="fenetre"
            class="hidden fixed top-16 right-5 w-2/3 text-white bg-mauve-btn text-2xl flex-col justify-center px-8 items-start gap-4 rounded-xl">
            <nav class="flex flex-col gap-4 items-start py-8">
                <a href="./index.php">Accueil</a>
                <a href="../process/start-quiz.php">Quiz</a>
                <a href="./utilisateur.php">Inscription</a>
                <a href="./score.php">Score</a>
                <a href="./classement.php">Classement</a>
            </nav>
        </div>

        <!-- MENU Desktop -->
        <nav class="hidden lg:flex lg:flex-row gap-8 items-center text-white">
            <a href="./index.php">Accueil</a>
            <a href="../process/start-quiz.php">Quiz</a>
            <a href="./utilisateur.php">Inscription</a>
            <a href="./score.php">Score</a>
            <a href="./classement.php">Classement</a>
        </nav>
    </header>