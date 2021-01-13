<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./SCSS/index.css">
    <title>Supprimer</title>
</head>
<body>
    <h1>Modifier</h1>
    <div class="ladiv">
        <form action="verif_supp.php" method="POST" name="formulaire">
            <table border=1>
            <?php 
                // include pour se connecter a la BDD
                include "include.php";
                // requete pour afficher le tableau avec des checkbox pour supprimer un stagiaire
                try
                {
                    $sql = "SELECT Id , Nom , Prenom , nationalite.Libelle AS Libelle_nationalite , type_formation.Libelle AS Libelle_formation FROM stagiaire INNER JOIN nationalite ON nationalite.Id_nationalite = stagiaire.Id_nationalite INNER JOIN type_formation ON type_formation.Id_type_formation = stagiaire.Id_type_formation";
                    // Préparation de la requête avec les marqueurs
                    $resultat = $base->prepare($sql);
                    $resultat->execute();
                    while ($ligne = $resultat->fetch())
                    {
                        echo '<tr>';
                            echo '<td>'.$ligne['Nom'].'</td>';
                            echo '<td>'.$ligne['Prenom'].'</td>';
                            echo '<td>'.$ligne['Libelle_nationalite'].'</td>';
                            echo '<td>'.$ligne['Libelle_formation'].'</td>';
                            echo '<td>';
                            // requete pour Afficher tous les formateurs et les salles avec la date aux quels etait inscrits le stagiaire
                            try
                            {
                                $sql2 = "SELECT Id_stagiaire , Nom , Prenom , salle.Libelle AS Libelle_salle , Date_debut , Date_fin FROM stagiaire_formateur INNER JOIN formateur ON formateur.Id_formateur = stagiaire_formateur.Id_formateur INNER JOIN salle ON formateur.Id_salle = salle.Id_salle WHERE Id_stagiaire = ".$ligne['Id']."";
                                // Préparation de la requête avec les marqueurs
                                $resultat2 = $base->prepare($sql2);
                                $resultat2->execute();
                                while ($ligne2 = $resultat2->fetch())
                                {
                                    
                                    echo '<p> - '.$ligne2['Nom']." ".$ligne2['Prenom'].' dans la salle : '.$ligne2['Libelle_salle'].' , Date de debut : '.$ligne2['Date_debut'].', Date de fin : '.$ligne2['Libelle_salle'].'</p>';
                                    
                                }
                                $resultat2->closeCursor();
                            }
                            catch(Exception $e)
                            {
                                // message en cas d'erreur
                                die('Erreur : '.$e->getMessage());
                            }
                            echo '</td>';
                            echo '<td><input type="checkbox" name="checkbox[]" id="" class="checkbox" value="'.$ligne['Id'].'"/></td>';
                        echo '</tr>';
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
                    echo '!!! Erreur dans la suppression !!! ';
                }
            ?>
            </table>
        <button type="submit" name="ok" value="supprimer"> Supprimer </button>
        </form>
        <p><a href="./index.php">Ajouter une autre personne<a><p>
    </div>
</body>
</html>