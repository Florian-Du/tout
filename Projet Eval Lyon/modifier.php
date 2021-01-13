<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./SCSS/index.css">
    <title>Modifier</title>
</head>
<body>
    <h1>Modifier</h1>
    <div class="ladiv">
        <form action="verif_modif.php" method="POST" name="formulaire">
            <table border=1>
            <?php
                // compteur numero 1
                $compteur = 0;
                // compteur numero 2
                $compteur2 = 0;
                // je me connecte a la BDD
                include "include.php";
                        // Requete pour afficher le tableau avec tous les inputs 
                        try
                        {
                            $sql = "SELECT Id , Nom , Prenom , nationalite.Libelle AS Libelle_nationalite , type_formation.Libelle AS Libelle_formation FROM stagiaire INNER JOIN nationalite ON nationalite.Id_nationalite = stagiaire.Id_nationalite INNER JOIN type_formation ON type_formation.Id_type_formation = stagiaire.Id_type_formation";
                            // Préparation de la requête avec les marqueurs
                            $resultat = $base->prepare($sql);
                            $resultat->execute();
                            while ($ligne = $resultat->fetch())
                            {
                                echo '<tr>';
                                    echo '<input type="hidden" name="Id[]" value="'.$ligne['Id'].'"/>';
                                    echo '<td><input type="text" name="Nom[]" value="'.$ligne['Nom'].'"/></td>';
                                    echo '<td><input type="text" name="Prenom[]" value="'.$ligne['Prenom'].'"/></td>';
                                    echo '<td><select name="nationalite[]">';
                                        //requete pour afficher toutes les options de nationalite
                                        try
                                        {
                                            $sql3 = "SELECT Id_nationalite , Libelle FROM nationalite";
                                            // Préparation de la requête avec les marqueurs
                                            $resultat3 = $base->prepare($sql3);
                                            $resultat3->execute();
                                            while ($ligne3 = $resultat3->fetch())
                                            {
                                                echo '<option value="'.$ligne3["Id_nationalite"].'">'.$ligne3["Libelle"].'</option>';
                                            }
                                            $resultat3->closeCursor();
                                        }
                                        catch(Exception $e)
                                        {
                                            // message en cas d'erreur
                                            die('Erreur : '.$e->getMessage());
                                        }
                                    echo '</td>';
                                    echo '<td><select name="type_formation[]" onchange="change_checkbox(event)">';
                                    // requete pour afficher toutes les options de type formations 
                                    try
                                        {
                                            $sql3 = "SELECT Id_type_formation , Libelle FROM type_formation";
                                            // Préparation de la requête avec les marqueurs
                                            $resultat3 = $base->prepare($sql3);
                                            $resultat3->execute();
                                            while ($ligne3 = $resultat3->fetch())
                                            {
                                                echo '<option value="'.$ligne3["Id_type_formation"].'">'.$ligne3["Libelle"].'</option>';
                                            }
                                            $resultat3->closeCursor();
                                        }
                                        catch(Exception $e)
                                        {
                                            // message en cas d'erreur
                                            die('Erreur : '.$e->getMessage());
                                        }
                                    echo '</select></td>';
                                    echo '<td>';
                                    // requete pour afficher tout les formateur auxquels le stagiaire est inscrits
                                    try
                                    {
                                        $sql2 = "SELECT Id_stagiaire , Nom , Prenom , salle.Libelle AS Libelle_salle , Date_debut , Date_fin , formateur.Id_formateur AS id_formateur FROM stagiaire_formateur INNER JOIN formateur ON formateur.Id_formateur = stagiaire_formateur.Id_formateur INNER JOIN salle ON formateur.Id_salle = salle.Id_salle WHERE Id_stagiaire = ".$ligne['Id']."";
                                        // Préparation de la requête avec les marqueurs
                                        $resultat2 = $base->prepare($sql2);
                                        $resultat2->execute();
                                        while ($ligne2 = $resultat2->fetch())
                                        {
                                            echo '<div>';
                                                echo '<input type="checkbox" name="checkbox_date[]" id="'.$ligne['Id'].'" class="checkbox" value="'.$compteur2.'" />';
                                                echo '<label for="'.$ligne['Id'].'">'.$ligne2["Prenom"].' '.$ligne2["Nom"].' dans la salle '.$ligne2["Libelle_salle"].' début : <input type="date" name="date_debut[]" value="'.date("Y-m-d").'" />, fin : <input type="date" name="date_fin[]" /> </label>';
                                                echo '<input type="hidden" name="id_formateur[]" value="'.$ligne2['id_formateur'].'"/>';
                                            echo '</div>';
                                            $compteur2++;
                                        }
                                        $resultat2->closeCursor();
                                    }
                                    catch(Exception $e)
                                    {
                                        // message en cas d'erreur
                                        die('Erreur : '.$e->getMessage());
                                    }
                                    echo '</td>';
                                    echo '<td><input type="checkbox" name="checkbox[]" id="" class="checkbox" value="'.$compteur.'" /></td>';
                                    $compteur++;
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
                            echo '!!! Erreur dans la modif !!! ';
                        }

                        // il manque d'afficher tous les autres formateur auxquels ils sont pas inscrits et ils faut aussi integrer le code js pour disabled ceux indisponibles par rapport aux types de formations 

            ?>
            </table>
            <button type="submit" name="ok" value="supprimer"> Modifier </button>
        </form>
        <p><a href="./index.php">Ajouter une autre personne<a><p>
    </div>
</body>
</html>