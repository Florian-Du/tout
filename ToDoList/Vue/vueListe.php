<?php $this->titre = "Se Connectez"; ?>


<article>
    <header>
        <form method="post" action="index.php?action=ajouterBillet">
            <input id="Identifiant" name="Identifiant" type="text" placeholder="Nom d'utilisateur" required /><br />
            <input id="mdp" name="mdp" type="password" placeholder="Mot De Passe" required /><br />
            <input type="submit" value="Commenter" />
        </form>
        <a href="<?="./index.php?action=pageLogin"?>">Se connectez</a>
    </header>
</article>

