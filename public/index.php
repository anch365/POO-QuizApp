<?php require_once "../_partials/_header.php"; ?>

<main class="flex flex-col gap-8">
    <section style="background-image: url('../assets/imgs/Bg-Quiz.jpg')" class="bg-size-[auto_250px] bg-bottom bg-no-repeat flex flex-col gap-8 items-center pb-8 sm:bg-size-[auto_300px] sm:bg-top">

        <h1 class="aclonica text-4xl">Bienvenu sur QuizApp</h1>
        <p>Répondez aux questions le plus vite possible pour gagner des points et tenter de terminer en tête du classement. Bonne chance ! 🚀🏆</p>

        <nav class="flex flex-col gap-8 md:flex-row">
            <a href="./login.php">
                <button type="submit" class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8 cursor-pointer">Connexion</button>
            </a>
            <a href="./utilisateur.php">
                <button type="submit" class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8 cursor-pointer">Inscrivez-vous</button>
            </a>
        </nav>
    </section>

    <section class="flex flex-col gap-8">

        <h2 class="aclonica text-3xl underline">Apprenez en vous amusant</h2>

        <div class="flex flex-wrap gap-8 items-center justify-center pt-16">
            
            <div class="flex flex-col items-center rounded-2xl overflow-hidden bg-améthyste text-white py-8 w-72">
                <div class="w-16 h-16 bg-white rounded-full overflow-hidden">
                    <img src="../assets/imgs/Q-Variées.jpg" alt="Carte pour les questions variées" class="object-cover">
                </div>
                <div class="flex flex-col gap-8 px-6 py-8">
                    <div class="aclonica text-2xl">Questions variées</div>
                    <p class="font-light">Culture générale, science, histoire...</p>
                </div>
            </div>

            <div class="flex flex-col items-center rounded-2xl overflow-hidden py-8 bg-améthyste text-white w-72">
                <div class="w-16 h-16 bg-white rounded-full overflow-hidden">
                    <img src="../assets/imgs/feedback.jpg" alt="Une image pour la présentation du feedback instantané">
                </div>
                <div class="flex flex-col gap-8 px-6 py-8">
                    <div class="aclonica text-2xl">Feedback</div>
                    <p class="font-light">Voir les résultats en temps réel</p>
                </div>
            </div>

            <div class="flex flex-col items-center rounded-2xl overflow-hidden py-8 bg-améthyste text-white w-72">
                <div class="w-16 h-16 bg-white rounded-full overflow-hidden">
                    <img src="../assets/imgs/Progression.jpg" alt="Une image pour la présentation du feedback instantané">
                </div>
                <div class="flex flex-col gap-8 px-6 py-8">
                    <div class="aclonica text-2xl">Suivi Progression</div>
                    <p class="font-light">Visionner votre progression en vous connectant</p>
                </div>
            </div>

        </div>
         <a href="../process/start-quiz.php">
                <button type="submit" class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8 cursor-pointer">Commencez le Quiz</button>
            </a>
    </section>
</main>

<?php require_once "../_partials/_footer.php" ?>