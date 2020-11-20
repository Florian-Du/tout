<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./SCSS/style.css" type="text/css" rel="stylesheet"></link>
    <title>Publiez</title>
</head>
<body>
    <h1>SkyBlog</h1>
    <h2>Publiez un post ! </h2>
    <p><a href="./index.php">Retournez au menu</a></p>
    <!-- Formulaire de publication  -->
    <form action="verif_publication.php" method="POST" name="formulaire" enctype="multipart/form-data">
        <input type="text" name="Titre" placeholder="Titre du post"/>
        <input type="text" name="Commentaire" placeholder="Commentaire du post"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="3097152"/>
        <input type="file" name="Image"/>
        <button type="submit" name="ok" value="envoyer"> Envoyer </button>
    </form>
    
    <?php
    //Si il y as une erreur dans le formulaire on dit a l'utisateur de reessayer
        if (isset($_REQUEST['poste']) && $_REQUEST['poste'] == 'ERREUR') {
            echo "<p> Erreur dans l'envoie de votre poste veuillez reessayer </p>";
        }
    ?>
</body>
</html>
