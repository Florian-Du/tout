<?php $this->titre = "Se Connectez"; ?>


<article>
    <header>
        <form class="add text-center p-2" method="post" action="index.php?action=ajouterUser">
            <input class="border p-2 rounded" id="Identifiant" name="Identifiant" type="text" placeholder="Nom d'utilisateur" required /><br />
            <input class="border p-2 rounded" id="mdp" name="mdp" type="password" placeholder="Mot De Passe" required /><br />
            <input class="border p-2 rounded" id="confirm_mdp" name="confirm_mdp" type="password" placeholder="Confirmer le Mot De Passe" required /><br />
            <input class="py-2 px-4 rounded bg-green-500 text-white" type="submit" value="S'enrengistrer" />
        </form>
        <a class="py-2 px-4 rounded bg-red-500 text-white" href="<?="./index.php?action=connexion"?>">Se connectez</a>
    </header>
</article>

