<?php
require_once "../utils/autoloader.php";      // ← EN PREMIER (pour charger les classes)
require_once "../utils/isConnected.php";
require_once "../utils/quizStarted.php";
require_once "../utils/db_connect.php";

$quiz = $_SESSION['quiz'];

if ($quiz->isFinished()) {
    header("Location: ../public/score.php");
    exit();
}

$repo = new QuizRepository($db);
$question = $repo->loadQuestion($quiz->getCurrentQuestionId());
?>

<?php
require_once "../_partials/_header.php";
?>
<main>
    <form action="../process/quiz.php" method="POST" id="quizForm"
        data-bonne-reponse="<?= $question->getBonneReponse()->getId() ?>"
        data-bon-texte="<?= htmlspecialchars($question->getBonneReponse()->getTexte()) ?>">

        <section class="flex flex-col gap-8 items-center">

            <div class="flex flex-col items-center gap-8 md:flex-row md:gap-32">
                <div class="flex flex-col items-center rounded-2xl overflow-hidden bg-baume-ivoire text-black py-8">
                    <div class="bg-white overflow-hidden">
                        <img src="../assets/imgs/<?= $question->getImage() ?>" alt="Une image respective pour chaque question" class="w-64 h-48 object-cover md:w-96">
                    </div>
                    <div class="flex flex-col gap-8 px-6 py-8">
                        <p class="font-light tracking-wider"><?= htmlspecialchars($question->getTexte()) ?></p>
                    </div>
                </div>

                <div class="aclonica text-white flex flex-col gap-8 w-full md:w-auto md:gap-4">

                    <div class="flex gap-4 items-center p-3 bg-mauve-btn rounded-xl">
                        <span class="text-xl font-bold" id="timer">15</span>
                        <span class="text-sm">secondes restantes</span>
                    </div>

                    <?php foreach ($question->getReponses() as $reponse) { ?>

                        <label class="cursor-pointer">
                            <input type="radio" name="reponse" class="peer hidden" value="<?= $reponse->getId() ?>">

                            <div
                                class="bg-améthyste rounded-xl py-4 border transition-all duration-20 peer-checked:border-pink-400 peer-checked:border-3">
                                <?= htmlspecialchars($reponse->getTexte()) ?>
                            </div>

                        </label>
                    <?php } ?>

                    <input
                        type="hidden"
                        name="question_id"
                        value="<?= $question->getId() ?>">
                </div>
            </div>
            <div id="feedbackZone" class="hidden aclonica text-center mt-4 p-4 rounded-xl text-lg font-bold"></div>

            <div class="pt-8">
                <button type="submit" class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8 text-black gayathri" disabled>validez</button>
            </div>
        </section>
    </form>
</main>

<?php
require_once "../_partials/_footer.php"
?>