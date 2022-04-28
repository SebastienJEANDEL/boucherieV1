<?php

namespace Oshop\Controllers;

use Oshop\Models\Type;

class MainController extends CoreController
{
    public function pageNotFound()
    {
        // Pour avoir une vraie page 404, il faut que la réponse
        // http retourne un code 404 (au lieu de 200 OK)
        header("HTTP/1.1 404 Not Found");
        $this->show('404');
    }

    // Méthode chargée de gérer la page d'accueil
    public function home()
    {
        // Récupérer les informations nécessaires pour cette page
        $types = new Type();
        $homeTypes = $types->findHomeTypes();

        // Délègue l'affichage à la méthode "show" du MainController
        $this->show('home', ['home_types' => $homeTypes]);
    }

    // Méthode chargée de gérer la page mentions légales
    public function legalMentions()
    {
        // Délègue l'affichage à la méthode "show" du MainController
        $this->show('legal-mentions');
    }

    public function test()
    {
        // Récupération des informations de la marque n°2
        // $brand = new Brand();
        // dump($brand->find(2));
        // si l'id n'existe pas dans la BDD, cela retournera false

        // Récupération de la liste des catégories
        $category = new Category();
        dump($category);
        dump($category->findAll());

        // Récupérer la catégorie numéro 2
        dump($category->find(2));

        // $type = new Type();
        // $type8 = $type->find(8);
        // dump($type8);
        // $type8->setName('Espadrilles');
        // dump($type8);
    }
}