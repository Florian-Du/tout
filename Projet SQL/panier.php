<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <?php
        session_start();
        if (isset($_POST['ajout_panier_quantite']) ) {
            try
                    {
                        $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT id_plat , id_personne , quantite FROM panier WHERE id_plat = ".$_POST['id_plat_panier']." AND id_personne =".$_SESSION['id_personne'] ;
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute();
                        
                        if ( $resultat->rowcount() == 0)
                            {

                                try
                                {
                                    $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                    $sql = "INSERT INTO panier (id_personne, id_plat, quantite) VALUES (:id_personne, :id_plat, :quantite)";
                                    // Préparation de la requête avec les marqueurs
                                    $resultat = $base->prepare($sql);
                                    $resultat->execute(array('id_personne' => $_SESSION['id_personne'],'id_plat' => $_POST['id_plat_panier'],'quantite' => $_POST['ajout_panier_quantite']));
                                    echo $base->lastInsertId().".";
                                    $resultat->closeCursor();
                                }
                                catch(Exception $e)
                                {
                                    // message en cas d'erreur
                                    die('Erreur : '.$e->getMessage());
                                }
                        }else {
                                try
                                {
                                    $quant = $resultat->fetch()['quantite']
                                    $quantite = $quant+$_POST["ajout_panier_quantite"]; //LE BUG IL EST LA BORDEL DE MERDE JE VAIS ME PENDRE
                                    $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                                    $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                                    $sql = "UPDATE panier SET quantite = ".$quantite." WHERE id_personne =".$_SESSION['id_personne']." AND id_plat = ".$_POST['id_plat_panier'];
                                    // Modification des données dans la table Personne
                                    $nombre = $base->exec($sql);
                                }
                                catch(Exception $e)
                                {
                                    // message en cas d'erreur
                                    die('Erreur : '.$e->getMessage());
                                }
                                
                            }  
                            $resultat->closeCursor();
                        
                    }

                    catch(Exception $e)
                    {
                        // message en cas d'erreur
                        die('Erreur : '.$e->getMessage());
                    }
                }
/*
                try
                    {
                        $base = new PDO('mysql:host=127.0.0.1;dbname=uber_tkt', 'root', 'root');
                        $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT plat.id_plat , quantite , plat.libelle AS libelle_plat , plat.prix AS plat_prix FROM panier INNER JOIN plat ON panier.id_plat = plat.id_plat WHERE id_personne = ".$_SESSION['id_personne'];
                        // Préparation de la requête avec les marqueurs
                        $resultat = $base->prepare($sql);
                        $resultat->execute();
                        while ($ligne = $resultat->fetch())
                        {
                            $prix = $ligne['quantite']*$ligne['plat_prix']." €";
                            echo '<h1>'.$ligne['libelle_plat'].'</h1>';
                            echo '<p>'.$ligne['quantite'].'</p>';
                            echo '<p>'.$prix.'</p>';
                        }

                        $resultat->closeCursor();
                    }
                    catch(Exception $e)
                    {
                        // message en cas d'erreur
                        die('Erreur : '.$e->getMessage());
                    }

        }*/
    ?>
</body>
</html>