<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./SCSS/index.css">
    <title>Index</title>
</head>
<body>
    <h1>Ajoutez un stagiaire</h1>
    <!-- Formulaire pour inscrire un stagiaire -->
    <div class="ladiv">
        <form action="verif_form.php" method="POST" name="formulaire">
            <input type="text" name="Nom" placeholder="Nom" class="Nom_Prenom1"/>
            <input type="text" name="prenom" placeholder="prenom" class="Nom_Prenom2"/>
            <p>Nationalité : <select name="nationalite">
                <?php
                    // include pour se connecter a la BDD
                    include "include.php";
                    // requete pour recuperer toutes les nationalités disponible
                    try
                    {
                        $sql = "SELECT Id_nationalite , Libelle FROM nationalite";
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute();
                        while ($ligne = $resultat->fetch())
                        {
                            echo '<option value="'.$ligne["Id_nationalite"].'">'.$ligne["Libelle"].'</option>';
                        }
                        $resultat->closeCursor();
                    }
                    catch(Exception $e)
                    {
                        // message en cas d'erreur
                        die('Erreur : '.$e->getMessage());
                    }
                ?>
            </select></p>
            <p>Type de la formation : <select name="type_formation" onchange="change_checkbox(event)">
                <?php
                    // requete pour recuperer tous les types de formations possible
                    try
                    {
                        $sql = "SELECT Id_type_formation , Libelle FROM type_formation";
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute();
                        while ($ligne = $resultat->fetch())
                        {
                            echo '<option value="'.$ligne["Id_type_formation"].'">'.$ligne["Libelle"].'</option>';
                        }
                        $resultat->closeCursor();
                    }
                    catch(Exception $e)
                    {
                        // message en cas d'erreur
                        die('Erreur : '.$e->getMessage());
                    }
                ?>
            </select></p>
            
                <?php
                    // requete pour recuperer tous les formateurs disponible
                    try
                    {
                        $sql = "SELECT formateur.Id_formateur AS formateur , Nom , Prenom , formateur.Id_salle , salle.Libelle AS salle_libelle FROM formateur INNER JOIN salle ON formateur.Id_salle = salle.Id_salle ";
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute();
                        while ($ligne = $resultat->fetch())
                        {
                            echo '<div>';
                            echo '<input type="checkbox" name="checkbox[]" id="'.$ligne["formateur"].'" value="'.$ligne["formateur"].'" class="checkbox ';
                            // requete pour recuperer les types de formations disponible pour le forateurs et les mettres en classes pour les recueprer en JS
                            try
                            {
                                $sql2 = "SELECT type_formation_formateur.Id_type_formation AS type_de_formation , Id_formateur FROM type_formation_formateur INNER JOIN type_formation ON type_formation.Id_type_formation = type_formation_formateur.Id_type_formation WHERE Id_formateur = ".$ligne['formateur']."";
                                // Préparation de la requête avec les marqueurs
                                $resultat2 = $base->prepare($sql2);
                                $resultat2->execute();
                                while ($ligne2 = $resultat2->fetch())
                                {
                                    echo $ligne2["type_de_formation"]." ";

                                }
                                $resultat2->closeCursor();
                            }
                            catch(Exception $e)
                            {
                                // message en cas d'erreur
                                die('Erreur : '.$e->getMessage());
                            }
                            echo '"></input> <label for="'.$ligne["formateur"].'">'.$ligne["Prenom"].' '.$ligne["Nom"].' dans la salle '.$ligne["salle_libelle"].' début : <input type="date" name="date_debut[]" value="'.date("Y-m-d").'" />, fin : <input type="date" name="date_fin[]" /> </label>';
                            echo '</div>';
                        }
                        $resultat->closeCursor();
                    }
                    catch(Exception $e)
                    {
                        // message en cas d'erreur
                        die('Erreur : '.$e->getMessage());
                    }
                    //gestion des erreur
                    if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'ERREUR') {
                        echo '!!! Erreur dans la creation !!! ';
                    }else if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'length_Prenom') {
                        echo '!!! Erreur dans la creation - Le prenom rentrer est trop long (longuer max = 30) !!! ';
                    }else if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'length_Nom') {
                        echo '!!! Erreur dans la creation - Le Nom rentrer est trop long (longuer max = 30)!!! ';
                    }else if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'not_date') {
                        echo '!!! Erreur dans la creation - La  date rentrez n\'est pas valide!!! ';
                    }
                ?>
            
            <button type="submit" name="ok" value="envoyer"> Envoyer </button>
            </form>
            <p><a href="modifier.php">Modifier</a></p><p><a href="supprimer.php">Supprimer</a></p>
        </div>
</body>
    <script src="./JS/JavaScript.js"></script>
    <script>
        <?php
            // Insertion du JS qui permet de disabled ou pas les checkbox en fonction du type de formations
            echo "
            var value = 1;
            function change_checkbox(event) {
                value =  event.target.value;
                var tab = document.getElementsByClassName('checkbox');
                for (var i = 0; i < tab.length ; i++) {
                    var LeLabel = tab[i].nextSibling.nextSibling;
                    var tabChildren = LeLabel.children;
                    for (var z = 0; z < tabChildren.length ; z++) {
                        tabChildren[z].disabled = true;
                    }
                    tab[i].disabled = true;
                    for (var j = 1; j < tab[i].classList.length; j++) {
                        if (tab[i].classList[j] == value) {
                            var tab2 = document.getElementsByClassName(tab[i].classList[j]);
                            for (var k = 0; k < tab2.length ; k++) {
                                tab2[k].disabled = false;
                            }
                            var LeLabel = tab[i].nextSibling.nextSibling;
                            var tabChildren = LeLabel.children;
                            for (var z = 0; z < tabChildren.length ; z++) {
                                tabChildren[z].disabled = false;
                            }
                            
                        }
                    }
                }
            }
            
            ";
        ?>
    </script>
</html>