<?php

namespace Oshop\Controllers;

// use Oshop\Models\Brand;
// use Oshop\Models\Category;
// use Oshop\Models\Type;
// Ecriture raccourcie :
use Oshop\Models\{Brand,Category,Type};


class CoreController
{
    // Méthode chargée de générer le HTML en incluant les
    // différents templates constituant une page
    // En passant la méthode show() en private, on fait en sorte 
    // qu'elle ne puisse pas être utilisée en dehors de la classe
    protected function show($viewName, $viewData = [])
    {
        // C'est pas très joli ce qu'on écrit là avec ce global,
        // mais c'est un moyen pratique à ce stade pour accéder plus
        // facilement à la variable $router
        global $router;

        extract($viewData);
        // https://www.php.net/manual/fr/function.extract.php
        // extract permet de créer des variables à partir des clés
        // d'un tableau associatif, ces variables contiendront les 
        // valeurs associées aux clés du tableau
        // Par exemple, si $ viewData contient :
        // $viewData = [
        //     'cle1' => 'valeur1',
        //     'cle2' => 'valeur2'
        // ];
        // Alors après extract($viewData), PHP va créer les variables suivantes :
        // $cle1 = 'valeur1';
        // $cle2 = 'valeur2';

        // $absoluteURL va nous permettre de préciser des URLs absolues
        // pour tous les liens et notamment nos assets (CSS, JS, etc...)
        // $_SERVER est une super globale (accessible partout dans notre code PHP)
        // et qui contient tout un ensemble d'informations sur le serveur et la requête HTTP
        // $_SERVER['BASE_URI'] contient le chemin depuis localhost (racine du serveur web) jusqu'au
        // répertoire public
        // par exemple : /Curie/S05/S05-projet-oShop-StephaneP43/public
        // On rajoute également le '/' manquant à la fin
        $absoluteURL = $_SERVER['BASE_URI'] . '/';

        // On récupère les données communes à toutes les pages
        // - la liste des marques dans le menu
        $brand = new Brand();
        $brandsList = $brand->findAll();
        // - la liste des catégories dans le menu
        $category = new Category();
        $categoriesList = $category->findAll();
        // - la liste des types dans le menu
        $type = new Type();
        $typesList = $type->findAll();
        // dump($typesList);

        require_once __DIR__ . '/../views/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/footer.tpl.php';
    }
}