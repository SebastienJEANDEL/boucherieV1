<?php 

// Avec le fichier .htaccess mis en place à la racine du dépôt,
// on fait en sorte de rediriger toutes les URLs vers index.php
// On a ainsi une sorte d'entonnoir qui renvoie tout vers le même
// fichier => index.php
// On appelle ce fichier le Front Controller.
// Toutes les pages passent forcément par ce Front Controller.

// ----------------------------------------------------------------
// Inclusion des classes
// ----------------------------------------------------------------

require __DIR__ . '/../vendor/autoload.php';

// function autoloadCustom($classNameToLoad)
// {
//     // $classNameToLoad = 'CoreController';
//     dump($classNameToLoad);

//     // s'il y a 'Controller' dans le nom de la classe $classNameToLoad
//     // alors on va charger le fichier depuis le répertoire app/Controllers
//     require __DIR__ . '/../app/Controllers/' . $classNameToLoad . '.php';
//     // sinon s'il y a 'Model' dans le nom de la classe $classNameToLoad
//     // alors on va charger le fichier depuis le répertoire app/Models
//     // mais il faudrait alors avoir renommmer tous nos models pour qu'il
//     // contiennent le mot Model
// }

// // Avec spl_autoload_register, on indique à PHP le nom d'une fonction
// // à appeler si jamais il ne trouve pas une classe
// spl_autoload_register('autoloadCustom');

// ----------------------------------------------------------------
// Préparation d'AltoRouter
// ----------------------------------------------------------------
$router = new AltoRouter();

// Comme la racine de notre site Oshop n'est pas située à la racine du serveur Web Apache
// (qui est directement http://localhost qui correspond au répertoire local /var/www/html)
// => on doit préciser où se situe la racine du site Oshop pour permettre à AltoRouter 
// d'analyser la bonne partie de l'URL : ce qui se trouve après 'public'
// Par exemple pour l'URL : http://localhost/Curie/S05/S05-projet-oShop-StephaneP43/public/catalogue/categorie
// on veut qu'AltoRouter analyse la partie après /public => /catalogue/categorie
// On pourrait donner la racine de notre en dur avec la méthode setBasePath d'AltoRouter comme ceci :
// $router->setBasePath('/Curie/S05/S05-projet-oShop-StephaneP43/public');
// MAIS malheureusement, on a tous des chemins vers notre répertoire public qui sont potentiellement
// différent.
// Heureusement, avec $_SERVER['BASE_URI'] (dont la valeur est calculée
// dans le fichier .htaccess du répertoire /public)
// on a une valeur dynamique qui fonctionnera chez tout le monde
// dump($_SERVER);
$router->setBasePath($_SERVER['BASE_URI']);

// ----------------------------------------------------------------
// Définition du tableau des routes
// ----------------------------------------------------------------

// Ajout de la route pour la page d'accueil
$router->map(
    'GET', // méthode HTTP qui est autorisée pour cette route
    '/', // la partie d'URL (après la racine du site) qui correspond à la page demandée
    // les informations qu'on récupérera plus tard quand AltoRouter
    // aura trouvé cette route
    [
        'controller' => 'MainController',
        'method' => 'home'
    ],
    'main-home' // un identifiant unique pour cette route
);

// Ajout de la route pour la page mentions légales
$router->map(
    'GET',
    '/mentions-legales/',
    [
        'controller' => 'MainController',
        'method' => 'legalMentions'
    ],
    'main-legal-mentions'
);

// Ajout de la route pour les pages catégories
$router->map(
    'GET',
    // on précise la partie dynamique entre crochets :
    // le i indique qu'on cherche un entier (integer)
    // id correspond au nom donné à la valeur extraite de l'URL
    // voir : https://altorouter.com/usage/mapping-routes.html
    '/catalogue/categorie/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'category'
    ],
    'catalog-category'
);

// Ajout de la route pour les pages types
$router->map(
    'GET',
    '/catalogue/type/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'type'
    ],
    'catalog-type'
);

// Ajout de la route pour les pages marques
$router->map(
    'GET',
    '/catalogue/marque/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'brand'
    ],
    'catalog-brand'
);

// Ajout de la route pour les pages produits
$router->map(
    'GET',
    '/catalogue/produit/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'product'
    ],
    'catalog-product'
);

// Ajout dd'une route pour nos tests pendant les développements
$router->map(
    'GET',
    '/test/',
    [
        'controller' => 'MainController',
        'method' => 'test'
    ],
    'main-test'
);

$match = $router->match();
// dump($match);

// Est-ce qu'il y a une route correspondant à la page demandée ?
if ($match !== false) {
// if ($match) {

    // Exemple de contenu de $match pour l'accueil
    // $match = [
    //     'target' => [
    //         'controller' => "CatalogController"
    //         'method' => "type"
    //     ],
    //     'params' => [
    //          'id' => "20"
    //     ],
    //     'name' => "catalog-type"
    // ];

    // On commence par récupérer les informations liés à la route demandée
    $routeInfos = $match['target'];

    // $routeInfos = [
    //     'controller' => "CatalogController"
    //     'method' => "type"
    // ];
    
    // On récupère ensuite le nom du contrôleur à instancier
    $controllerToUse = 'Oshop\\Controllers\\' . $routeInfos['controller'];
    // $controllerToUse = "CatalogController";

    // On récupère enfin le nom de la méthode à appeler
    $methodToCall = $routeInfos['method'];
    // $methodToCall = "type";

    // On récupère les informations dynamiques extraites de l'URL
    $urlParams = $match['params'];
    // $urlParams = [
    //     'id' => "20"
    // ]

    // On instancie le contrôleur
    $controller = new $controllerToUse();
    // $controller = new CatalogController();
    
    // var_dump($routeInfos);
    // var_dump($controllerToUse);
    // var_dump($methodToCall);
    // var_dump($controller);

    // On appelle la méthode sur ce contrôleur
    // Exemple pour l'URL : /catalogue/categorie/23
    // PHP appelerait 
    // $controller->$methodToCall([
    //     'id' => 23
    // ]);

    $controller->$methodToCall($urlParams);
    // $controller->type(['id' => "20"]);
} else {
    // Page 404
    $controller = new Oshop\Controllers\MainController();
    $controller->pageNotFound();
}