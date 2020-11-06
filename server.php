<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files</title>
</head>
<body>
    <form action="requete.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
        <p>Choisissez une photo avec une taille inférieure à 2 Mo.</p>
        <input type="file" name="photo">
        <br/>
        <input type="submit" name="ok" value="Envoyer">
    </form>
    <form action="requetePOST.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="prenom"/>
        <input type="text" name="nom"/>
        <input type="password" name="champ1" value="valeur1"/>
        <textarea name="champ2">Valeur 2 </textarea>
        <select name="pays">
            <option value="F">France</option>
            <option value="E">Espagne</option>
            <option value="R">Russie</option>
        </select>
        <select name="pay[]" multiple="multiple">
            <option value="F">France</option>
            <option value="E">Espagne</option>
            <option value="R">Russie</option>
            <option value="A">Allemagne</option>
        </select>
        <input type="checkbox" name="payss[]" value="F" />France<br />
        <input type="checkbox" name="payss[]" value="E" />Espagne<br />
        <input type="checkbox" name="payss[]" value="R" />Russie<br />
        <input type="checkbox" name="payss[]" value="A" />Allemagne<br />


        <input type="radio" name="payy" value="F" />France<br />
        <input type="radio" name="payy" value="E" />Espagne<br />
        <input type="radio" name="payy" value="R" />Russie<br />
        <input type="radio" name="payy" value="A" />Allemagne<br />
        <button type="submit" name="ok" value="Envoyer">envoyer</button>
    </form>
</body>
</html>