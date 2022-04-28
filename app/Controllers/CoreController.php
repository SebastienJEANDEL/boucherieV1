<?php

namespace Oshop\Controllers;

// use Oshop\Models\Brand;
// use Oshop\Models\Category;
// use Oshop\Models\Type;
// Ecriture raccourcie :
use Oshop\Models\{Animal,Producer,Piece,Race};


class CoreController
{
    // Méthode chargée de générer le HTML en incluant les
    // différents templates constituant une page
    // En passant la méthode show() en private, on fait en sorte 
    // qu'elle ne puisse pas être utilisée en dehors de la classe
    protected function show($viewName, $viewData = [])
    {
        
        global $router;

        extract($viewData);
        
        // On rajoute également le '/' manquant à la fin
        $absoluteURL = $_SERVER['BASE_URI'] . '/';

        // On récupère les données communes à toutes les pages
        // - la liste des marques dans le menu
        $race = new Race();
        $racesList = $race->findAll();
        // - la liste des catégories dans le menu
        $piece = new Piece();
        $piecesList = $piece->findAll();
        // - la liste des types dans le menu
        $animal = new Animal();
        $animalsList = $animal->findAll();
        // dump($typesList);
         // - la liste des types dans le menu
         $producer = new Producer();
         $producersList = $producer->findAll();
         // dump($typesList);

        require_once __DIR__ . '/../views/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/footer.tpl.php';
    }
}