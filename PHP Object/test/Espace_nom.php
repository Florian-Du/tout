<?php
// Définition de l’espace de noms.
namespace Biliotheque;
// Définition d’une constante.
const PI = 3.1416;
// Définition d’une fonction.
function maFonction() {
echo "Bonjour <br />";
}
// Définition d’une classe.
class Animal
{
// Déclaration des attributs
private $couleur = "gris";
//accesseurs
public function getCouleur()
{
return $this->couleur; //retourne la couleur
}
public function setCouleur($couleur)
{
$this->couleur = $couleur; //écrit dans l'attribut couleur
}
}
?>