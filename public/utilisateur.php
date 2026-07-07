<?php require_once "../_partials/_header.php"; ?>
<h2 class="aclonica">INSCRIVEZ-VOUS</h2>

<form action="../process/utilisateur.php" method="post" class="flex flex-col items-center gap-8  bg-baume-ivoire rounded-xl p-8">

    <div class="flex flex-col gap-8 items-center md:p-16 md:flex-row md:flex-wrap md:items-center">
        <div class="flex flex-col tracking-wider">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" placeholder="Supergirl" class="text-center rounded-xl bg-white h-12" minlength="3" maxlength="30" required>
        </div>
        <div class="flex flex-col tracking-wider">
            <label for="mail">Adresse email</label>
            <input type="mail" name="mail" id="mail" placeholder="test.test@test.fr" class="text-center rounded-xl bg-white h-12" minlength="3" maxlength="30" required>
        </div>
        <div class="flex flex-col tracking-wider">
            <label for="motdepasse">Mot de passe</label>
            <input type="password" name="motdepasse" id="motdepasse" placeholder="Jnfg@12-Amh" class="text-center rounded-xl bg-white h-12" minlength="3" maxlength="30" required>
        </div>
    </div>

    <button type="submit" class="bg-mauve-btn font-bold rounded-full w-fit py-2 px-8">Connexion</button>
</form>

<?php require_once "../_partials/_footer.php" ?>