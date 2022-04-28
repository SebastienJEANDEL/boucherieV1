<?php 

// ----------------------------------------------------------------
// Inclusion des classes
// ----------------------------------------------------------------

require __DIR__ . '/../vendor/autoload.php';


// ----------------------------------------------------------------
$router = new AltoRouter();


$router->setBasePath($_SERVER['BASE_URI']);

// ----------------------------------------------------------------
// Définition du tableau des routes
// ----------------------------------------------------------------

// Ajout de la route pour la page d'accueil
$router->map(
    'GET', // méthode HTTP qui est autorisée pour cette route
    '/', // la partie d'URL (après la racine du site) qui correspond à la page demandée
    
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

// Ajout de la route pour le lien types dans les navBar
$router->map(
    'GET',
    '/catalogue/type/[i:id]',
    [
        'controller' => 'MainController',
        'method' => 'type'
    ],
    'main-type'
);

// Ajout de la route pour les pages raceList
$router->map(
    'GET',
    '/catalogue/race/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'race'
    ],
    'catalog-race'
);

// Ajout de la route pour les pages animalList
$router->map(
    'GET',
    '/catalogue/animalList/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'animalList'
    ],
    'catalog-animalList'
);

// Ajout de la route pour les pages animalDetails
$router->map(
    'GET',
    '/catalogue/animalDetails/[i:id]',
    [
        'controller' => 'CatalogController',
        'method' => 'animalDetails'
    ],
    'catalog-animalDetails'
);
// Ajout de la route pour la page cartDetail
$router->map(
    'GET',
    '/topping/cartDetail/[i:id]',
    [
        'controller' => 'ToppingController',
        'method' => 'animalDetails'
    ],
    'topping-cartDetail'
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