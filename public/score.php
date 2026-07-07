<?php
require_once "../utils/isConnected.php";
require_once "../utils/db_connect.php";
require_once "../utils/autoloader.php";

$quiz = $_SESSION['quiz'] ?? null;

if (!$quiz) {
    header("Location: ./index.php");
    exit();
}

$score = $quiz->getScore();
$nbQuestions = $quiz->getTotal();
$temps_total = $quiz->getTempsEcoule();
$pourcentage = $nbQuestions > 0 ? round(($score / $nbQuestions) * 100) : 0;
$pourcentageFaux = 100 - $pourcentage;

// Nettoyer la session
unset($_SESSION['quiz']);

?>

<?php require_once "../_partials/_header.php"; ?>

<main class="flex flex-col gap-16 items-center">
    <h1 class="aclonica text-3xl">🏁 Résultat du quiz</h1>

    <div class="bg-baume-ivoire rounded-xl p-8 flex flex-col gap-16 items-center w-full max-w-md">
        <div>
            <p class="text-xl">Ton score : <strong class="text-2xl"><?= $score ?>/<?= $nbQuestions ?></strong></p>
            <p>Temps total : <strong><?= $temps_total ?> secondes</strong></p>
        </div>

        <!-- Graphique -->
        <div class="flex items-end gap-8 w-full justify-center lg:flex-row lg:gap-32">
            <div class="flex flex-col items-center gap-1">
                <span class="font-bold text-green-600"><?= $score ?></span>
                <div class="w-16 bg-green-500 rounded-t-lg" style="height: <?= $pourcentage * 1.2 ?>px"></div>
                <span class="text-xs">✅ Correct</span>
            </div>

            <div class="flex flex-col items-center gap-1">
                <span class="font-bold text-red-500"><?= $nbQuestions - $score ?></span>
                <div class="w-16 bg-red-400 rounded-t-lg" style="height: <?= $pourcentageFaux * 1.2 ?>px"></div>
                <span class="text-xs">❌ Incorrect</span>
            </div>
        </div>
        
        <p class="text-lg font-bold"><?= $pourcentage ?>% de réussite</p>
    </div>

    <a href="../process/reset-quiz.php">
        <button class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8 cursor-pointer">🔄 Refaire le quiz</button>
    </a>
</main>

<?php require_once "../_partials/_footer.php"; ?>