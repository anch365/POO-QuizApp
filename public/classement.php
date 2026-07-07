<?php
require_once "../utils/isConnected.php";
require_once "../utils/db_connect.php";

// Top 10
$request = $db->query("SELECT u.pseudo, s.score, s.temps_total
    FROM score s
    JOIN utilisateur u ON s.utilisateur_id = u.id
    ORDER BY s.score DESC, s.temps_total ASC
    LIMIT 10
");
$classement = $request->fetchAll(PDO::FETCH_ASSOC);

// Meilleur score perso
$request = $db->prepare("SELECT MAX(score) as best_score, MIN(temps_total) as best_time
    FROM score WHERE utilisateur_id = :uid
");
$request->execute([':uid' => $_SESSION['user']['id']]);
$monScore = $request->fetch(PDO::FETCH_ASSOC);
?>

<?php require_once "../_partials/_header.php"; ?>

<style>
    /* Animation d'entrée des lignes */
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-30px); }
        to   { opacity: 1; transform: translateX(0); }
    }
    .ligne-anim { animation: slideIn 0.4s ease forwards;}

    /* Podium */
    @keyframes bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }
    .bounce { animation: bounce 0.8s ease infinite; }
    .bounce-1 { animation-delay: 0s; }
    .bounce-2 { animation-delay: 0.2s; }
    .bounce-3 { animation-delay: 0.4s; }

    /* Étoiles */
    @keyframes sparkle {
        0%,100% { opacity:0.3; transform:scale(0.8); }
        50%     { opacity:1;   transform:scale(1.2); }
    }
    .sparkle { animation: sparkle 1.5s ease infinite; display: inline-block; }

    /* Surbrillance joueur connecté */
    @keyframes glow {
        0%,100% { box-shadow: 0 0 5px #c084fc; }
        50%     { box-shadow: 0 0 20px #c084fc; }
    }
    .my-row { animation: glow 2s ease infinite;}
</style>

<main class="flex flex-col gap-8 items-center">
    <h1 class="aclonica text-3xl">
        🏆 Classement
        <span class="sparkle">✨</span>
    </h1>

    <!-- Mon score -->
    <div class="bg-mauve-btn text-white rounded-xl px-6 py-3 flex gap-4 items-center">
        <span class="text-2xl">🎮</span>
        <span>
            Mon record : <strong><?= $monScore['best_score'] ?? 0 ?> pts</strong>
            <?php if ($monScore['best_time']) echo " — {$monScore['best_time']}s"; ?>
        </span>
    </div>

    <!-- Podium -->
    <?php if (!empty($classement)) { ?>
    <div class="flex items-end gap-4 justify-center h-40 mt-4">
        <!-- 2ème place -->
        <?php if (isset($classement[1])) { ?>
        <div class="flex flex-col items-center gap-2">
            <span class="text-2xl">🥈</span>
            <span class="font-bold text-sm"><?= htmlspecialchars($classement[1]['pseudo']) ?></span>
            <div class="bg-blue-400 rounded-t-lg w-20 flex items-end justify-center font-bold text-white" style="height:70px">
                <?= $classement[1]['score'] ?>pts
            </div>
        </div>
        <?php } ?>

        <!-- 1ère place -->
        <div class="flex flex-col items-center gap-2">
            <span class="text-4xl">👑</span>
            <span class="font-bold text-sm"><?= htmlspecialchars($classement[0]['pseudo']) ?></span>
            <div class="bg-red-500 rounded-t-lg w-24 flex items-end justify-center font-bold text-white" style="height:100px">
                <?= $classement[0]['score'] ?>pts
            </div>
        </div>

        <!-- 3ème place -->
        <?php if (isset($classement[2])) { ?>
        <div class="flex flex-col items-center gap-2">
            <span class="text-2xl">🥉</span>
            <span class="font-bold text-sm"><?= htmlspecialchars($classement[2]['pseudo']) ?></span>
            <div class="bg-purple-400 rounded-t-lg w-20 flex items-end justify-center font-bold text-white" style="height:50px">
                <?= $classement[2]['score'] ?>pts
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>

    <!-- Tableau -->
    <div class="bg-baume-ivoire rounded-xl p-6 w-full max-w-md">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b-2 border-purple-200">
                    <th class="py-2 w-8">#</th>
                    <th>Joueur</th>
                    <th class="text-right">Score</th>
                    <th class="text-right">Temps</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classement as $index => $row) { 
                    $medal = match($index) { 0 => '🥇', 1 => '🥈', 2 => '🥉', default => '' };
                    $isMe = $row['pseudo'] === $_SESSION['user']['pseudo'];
                ?>
                <tr class="border-b border-purple-100 ligne-anim <?= $isMe ? 'my-row font-bold' : '' ?>" 
                    style="animation-delay: <?= $index * 0.1 ?>s">
                    <td class="py-3"><?= $medal ?: $index + 1 ?></td>
                    <td><?= htmlspecialchars($row['pseudo']) ?><?= $isMe ? ' ⭐' : '' ?></td>
                    <td class="text-right"><?= $row['score'] ?></td>
                    <td class="text-right"><?= $row['temps_total'] ?>s</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="../process/start-quiz.php">
        <button class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8 cursor-pointer hover:scale-105 transition-transform">
            🎮 Jouer une partie
        </button>
    </a>
</main>

<?php require_once "../_partials/_footer.php"; ?>