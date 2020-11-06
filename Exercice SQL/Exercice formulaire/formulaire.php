<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <h1>Bienvenue sur le site d'inscription "Formation pour tous"</h1>
    <h3>Veuillez remplir tous tous les champs de formulaire et</h3>
    <h3>Cliquez sur le bouton Envoyer pour valider votre inscription</h3>

    <form id="forumlaire" method="POST" name="formulaire">
        <p>Nom : <input type="text" name="nom" placeholder="Entrez un nom" required="required" /></p>
        <p>Prénom : <input type="text" name="prenom" placeholder="Entrez un prenom" required="required" /></p>
        <p>Intitulé de la formation : <input type="text" name="Intitule" placeholder="Entrez un intitule" required="required" /></p>
        <p>Date de début de la formation : <input type="date" name="Date_debut" placeholder="Entrez une date de début" required="required"/></p>
        <p>Date de fin de la formation : <input type="date" name="Date_fin" placeholder="Entrez une date de fin" required="required"/></p>
        <p>Adresse email : <input type="text" name="Email" placeholder="Entrez une adresse email valide" required="required"/></p>
        <p><input type="checkbox" name="checkbox" required="required"/> J'accepte les conditions visibles sur ce <a onclick="clique_condition()" id="condition" name="condition" href="./condition.html" target="_blank">lien</a></p>
        <button id="boutton" name="ok" value="envoyer" style="background-color: red; display: none;"> Envoyer </button>
    </form>
        <button id="boutton2" style="background-color: red;"> Envoyer </button>

    <?php
    // si formulaire est OK afficher le message "fomulaire bien envoyer"
    if (isset($_REQUEST['formulaire']) || isset($_REQUEST['checkbox'])) {
        if ($_REQUEST['formulaire'] == "OK") {
            echo '<p> Formulaire bien envoyer </p>';
        }else if ($_REQUEST['checkbox'] == "off"){
            echo '<p> Vous n\'avez pas cocher la checkbox </p>';
        }
    }
        
    ?>
</body>
    <script> 
        function clique_condition() {
            var boutton = document.getElementById("boutton");
            boutton.setAttribute("type","submit");
            boutton.style.backgroundColor = "green";
            boutton.style.display = "block";

            var boutton2 = document.getElementById("boutton2");
            boutton2.style.display = "none";

            var formulaire = document.getElementById("forumlaire");
            formulaire.setAttribute("action","verif_formulaire.php");
        }
        
    </script>
</html>