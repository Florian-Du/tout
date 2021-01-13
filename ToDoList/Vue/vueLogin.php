<?php $this->titre = "Se Connectez"; ?>
<?php
    if (isset($_SESSION['Id_User'])){
        session_destroy();
    }
?>

    <article>
        <header>
            <form class="add text-center p-2" method="post" action="index.php?action=Login">
                <input class="border p-2 rounded" id="Identifiant" name="Identifiant" type="text" placeholder="Nom d'utilisateur" required /><br />
                <input class="border p-2 rounded" id="mdp" name="mdp" type="password" placeholder="Mot De Passe" required /><br />
                <input class="py-2 px-4 rounded bg-green-500 text-white" type="submit" value="Se connecter" />
            </form>
            <a class="py-2 px-4 rounded bg-red-500 text-white" href="<?="./index.php?action=pageRegister"?>">S'enrengistrer</a>
        </header>
    </article>

