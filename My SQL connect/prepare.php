<?php
// Connexion à la base de données
$base = mysqli_connect("127.0.0.1", "root", "root", "base1");
if ($base) {
echo 'Connexion réussie.<br />';
echo 'Informations sur le serveur:'.mysqli_get_host_info($base).'<br />';
$sql = "INSERT INTO Personne (Id_personne, Nom,Prenom , Age ,Id_Langue,Superieur) VALUES (?,?,?,?,?, ?)";
// Préparation de la requête
$resultat = mysqli_prepare($base, $sql);
// Liaison des paramètres.
$ok = mysqli_stmt_bind_param($resultat, 'issiis',$id,$Nom,$prenom,$age,$Id_Langue,$Superieur);
$id = 1; //Ajout d'un identifiant déjà existant
$Nom = 'Abdoul';
$prenom = 'Monique';
$age = 63;
$Id_Langue = 3;
$Superieur = 'Dupin';
// Exécution-de la requête.
$ok = mysqli_stmt_execute($resultat);
if ($ok == FALSE) {
echo "Echec de l'exécution de la requête.<br />";
echo "erreur : ".mysqli_stmt_errno($resultat).' - '.mysqli_stmt_error($resultat)."<br />";
}
else {
echo "Personne ajoutée.<br />";
}
mysqli_stmt_close($resultat);
if (mysqli_close($base)) {
echo 'Déconnexion réussie.<br />';
}
else {
echo 'Echec de la déconnexion.';
}
}
else {
printf('Erreur %d : %s.<br/>',mysqli_connect_errno(),mysqli_connect_error());
}
?>