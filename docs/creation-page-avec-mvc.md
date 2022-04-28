# Création d'une page avec MVC

## Route

- définir la route (pour nous via AltoRouter et la méthode map()) dans le FrontController (index.php)
- une route permet de gérer une URL précise (avec ou sans partie dynamique)
- et d'y associer un nom de contrôleur et une méthode
- une fois les routes définies, le _Dispatcher_ va s'occuper d'instancier le _Controller_ puis d'appeler la méthode associée à l'URL demandée

## Controller

- créer le _Controller_ s'il n'existe pas encore
- déclarer la méthode (définie dans la route) dans ce _Controller_ (si la méthode n'existe pas encore)
- dans le corps de cette méthode :
  - récupérer les données :
    - celles extraites de l'URL (s'il y en a)
    - utiliser les _Models_ et leurs méthodes pour récupérer les informations nécessaires issues de la BDD
  - une fois les données récupérées : on les transmet à la vue pour générer le HTML 
    - pour cela, appeler la méthode `show()` qui appelle les différents templates et leurs transmet les données (pour qu'ils puissent générer le HTML de la page)
- ℹ️ Si les données concernent toutes les pages, on les récupère dans la méthode `show()`, et si elles concernent une page particulière, on les récupère dans la méthode associée à cette page (ex: `category()` pour la page catégorie)

## Model

- plus haut, on parle de : "_récupérer les données_" : c'est le rôle des _Models_ !
- les _Models_ sont des classes qui représentent les données manipulées et qui contiennent des méthodes pour communiquer avec la BDD (principe Active Record)
- pour chaque donnée nécessaire à la page :
  - instancier le _Model_ correspondant à la table dans laquelle se trouvent les données souhaitées
    - s'il n'y a pas de méthode correspondante, on crée une nouvelle méthode dans le _Model_ et on l'implémente
  - sur l'objet _Model_, appeler la méthode retournant les données nécessaires (et au niveau du code de la méthode du _Controller_ stocker le résultat retourné dans une variable et enfin le transmettre à la méthode `show()`)

- Ecriture d'une méthode de récupération des données dans le _Model_
Quand on créé une méthode dans la classe d'un Model pour aller
chercher les informations dans la BDD :
1. Déclaration de la méthode
2. Récupération de la connexion à la BDD (object PDO)
3. Ecriture de la requête SQL dans une variable de type string
4. Exécution de la requête SQL avec query() (si c'est une requête SELECT)
en fournissant en argument la variable contenant la requête SQL
5. Récupération/formatage du résultat :
    - soit 1 seul résultat => $pdoStatement->fetch() ou
        $pdoStatement->fetchObject()
    - soit plusieurs résultats => $pdoStatement->fetchAll()
Précisions :
    - si on va chercher l'information dans 1 seule table :
        => 1 seul résultat : fetchObject('NomClasseAInstancier')
        => plusieurs résultats : fetchAll(PDO::FETCH_CLASS, 'NomClasseAInstancier')
    - si on va chercher l'information dans plusieurs tables, alors
    on utilisera PDO::FETCH_ASSOC car on ne veut par obtenir des objets
    qui ne respectent pluas leur plan de fabrication (class) et qui auraient
    des propriétés public en plus créées à la volée par PDO
6. Retourner le résultat (tableau ou objet)

## View

- créer une _View_ si elle n'existe pas encore
- mélanger code HTML et code PHP (pour les parties dynamiques)
- la _View_ va utiliser les données transmises par la méthode du _Controller_
  - par exemple : `<?= $varToDisplay ?>`
  - pour l'affichage, on abuse des dump pour visualiser les données manipulées et pouvoir s'adapter en fonction du type de donnée :
    - array
    - object
    - string
    - ...