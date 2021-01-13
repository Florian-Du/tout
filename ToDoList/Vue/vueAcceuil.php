<?php $this->titre = "Acceuil"; ?>

<?php
    if (!isset($_SESSION['Id_User'])) {
        header("Location:index.php?action=connexion");
    }
?>

<?php foreach ($Listes as $Liste):?>
    <hr />
    <article class="w-full mt-2">
        <h1 class="px-4 todo-item p-2"><?= $Liste['nom']?></h1>
    </article>
<?php endforeach; ?>
<hr />

<br /><a class="py-2 px-4 rounded bg-red-500 text-white" href="<?="./index.php?action=connexion"?>">Se connectez</a>
