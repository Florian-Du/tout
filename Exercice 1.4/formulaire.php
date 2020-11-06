<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Champ nombre</title>
</head>
<body>
    <form action='verif_formulaire.php' method='POST'>
        <input type="number" name="number" placeholder="number" />
        <button type="submit"> Envoyer</button>
    </form>
    <?php
        if (isset($_REQUEST['Nombre'])) {
            echo "<form>";
            for ($i=1; $i < $_REQUEST['Nombre']+1; $i++) { 
                echo "<input type='text' placeholder='".$i."' name='champ".$i."'onclick='clique(event)'/>";
            }
            echo "</form>";
        }
    ?>
</body>
        <script>
            function clique(event) {
                alert(event.target.name);
            }
        </script>
</html>