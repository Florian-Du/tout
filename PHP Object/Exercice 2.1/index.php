<?php
    //Affectation de la fonction gérant l’autoload
    spl_autoload_register('monAutoload');
    function monAutoload($className)
    {
    //Les classes sont dans le dossier class
        $path = './';
    //Le nom des fichiers doit correspondre au nom de la classe
    include $path.$className.'.class.php';
    }

/*
    include "Vehicule.class.php";
    include "Quatre_roues.class.php";
    include "Voiture.class.php";
    include "Action.class.php";
    include "Camion.class.php";
    include "Deux_roues.class.php";
*/

    $voiture_verte = new Voiture("verte",1400,2);
    $voiture_verte->rouler();
    $voiture_verte->ajouter_personne(65);
    $voiture_verte->ajouter_personne(65);
    echo $voiture_verte->getPoids()." Kg </br>";
    echo $voiture_verte->getCouleur()."</br>";
    $voiture_verte->repeindre("rouge");
    $voiture_verte->ajouter_pneu_neige(2);
    echo $voiture_verte->getCouleur()."</br>";
    echo "La voiture est equipe de ".$voiture_verte->getNombre_pneu_neige()." pneu neige</br>";
    $moto = new Deux_roues("noir",120);
    $moto->ajouter_personne(80);
    $moto->mettre_essence(20);
    echo $moto->getPoids()." Kg </br>";
    echo $moto->getCouleur()."</br>";
    $camion_bleu = new Camion("bleu",10000,2);
    $camion_bleu->setLongueur(10);
    $camion_bleu->setNombre_Portes(2);
    $camion_bleu->ajouter_remorque(5);
    $camion_bleu->ajouter_personne(80);
    echo $camion_bleu->getCouleur()."</br>";
    echo $camion_bleu->getPoids()." Kg </br>";
    echo $camion_bleu->getLongueur()." metres </br>";
    echo $camion_bleu->getNombre_portes()." portes </br>";
    $moto2 = new Deux_roues("rouge",150);
    $moto2->ajouter_personne(70);
    echo $moto2->getPoids()." Kg </br>";
    $moto2->setCouleur("vert");
    $moto2->setCylindree(1000);
    Vehicule::afficher_attribut($moto2);
    $camion_blanc = new Camion("blanc",6000,2);
    $camion_blanc->ajouter_personne(84);
    $camion_blanc->repeindre("bleu");
    $camion_blanc->setNombre_Portes(2);
    Vehicule::afficher_attribut($camion_blanc);
    $Voiture = new Voiture("verte",2100,4);
    $Voiture->ajouter_pneu_neige(2);
    $Voiture->ajouter_personne(80);
    $Voiture->repeindre("bleu");
    $Voiture->enlever_pneu_neige(4);
    $Voiture->repeindre("noir");
    Vehicule::afficher_attribut($Voiture);
    $camion3 = new camion("bleu",10000,2);
    $camion3->setLongueur(10);
    $camion3->mettre_essence(100);
    $camion3->repeindre("vert");
    Vehicule::afficher_attribut($camion3);