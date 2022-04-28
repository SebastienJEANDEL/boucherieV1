# Namespaces et autoload

## Définition et avantages

### Namespaces

Les namespaces (espaces de nom) permettent d'organiser/ranger les classes de notre projet dans des répertoires virtuels.

Ces répertoires virtuels ne permettent pas d'avoir 2 classes du même nom rangées dans le même répertoire (comme sur notre disque dur) => cela nous force à organiser nos classes proprement dans nos namespaces.

## Avantages

#### Eviter les conflits de classes

Grâce aux namespaces, en déclarant un nom racine (par exemple `\Oshop`) ainsi qu'une structure de répertoires virtuels propre à notre projet, nous évitons quasiment tout risque de conflit entre les classes de notre projet et les classes des librairies externes utilisées dans notre projet. (En effet, PHP ne permet pas d'utiliser 2 classes ayant le même nom, sauf si elles sont rangées dans 2 namespaces différents.)

#### Permettre le chargement automatique des classes

Les namespaces facilitent également la mise en place du chargement automatique des classes (via `composer`). Grâce à ce chargement automatique, on peut charger uniquement les classes qui sont réellement nécessaires pour l'exécution du script PHP (cela évite de charger potentiellement des centaines voire des miliiers de classes qui seraient dans notre projet mais qui ne servent pas toutes en même temps pour chacune des pages de notre site => certaines pages utiliseront 25 classes et d'autres 139 classes...).

On optimise ainsi le chargement de la page (temps et ressources utilisés).

## Mise en place

### #1 - Configurer l'autoload avec `composer`

Dans le fichier `composer.json` situé à la racine du dépôt, on rajoute :

```
"autoload": {
        "psr-4": {
            "NomDuProjet\\": "app/"
        }
    }
```

`NomDuProjet` correspondra à la racine des namespaces pour toute notre application.

Ce nom est choisi de façon arbitraire, mais en choisissant le nom du projet, cela nous permet de nous distinguer des autres namespaces utilisés dans le code externe des librairies/dépendances présentes dans notre projet.

A cette racine de namespace, on associe `app/` qui est le répertoire physique où se trouvent toutes les classes de notre application.

Pour la prise en compte par `composer` et pour chaque modification de la configuration de l'autoload, on doit exécuter dans le terminal (à la racine du dépôt) :

```
composer dump-autoload
```

C'est cette commande qui permet de dire à `composer` de suivre la norme PSR-4 (https://www.php-fig.org/psr/psr-4/).

Si on fait un `composer install` il n'est pas nécessaire de refaire un composer `dump-autoload`.

On n'oublie pas d'inclure le fichier `autoload.php` du répertoire `vendor`, car c'est ce fichier qui va gérer l'autoloading.

### #2 - On range chaque classe dans un namespace

Au début de chaque fichier contenant une classe PHP, on précise le namespace (répertoire virtuel) dans lequel elle se trouve/se range.

La déclaration du namespace doit être la toute première chose dans le fichier de classe. Elle se fait donc avant la déclaration de la classe (avec `class MaClasse`).

Exemple pour la classe `MainController` se situant dans le répertoire physique `app/Controllers` :

```php
<?php
    
namespace NomDuProjet\Controllers;

class MainController
{
    
}
```

### #3 - Utilisation de nos classes

Désormais, `MainController` ne suffit plus pour déterminer la classe `MainController` qui se situe dans le répertoire physique `app/Controllers` et dans le répertoire virtuel `NomDuProjet\Controllers`.

On va devoir utiliser son Fully Qualified Class Name (FQCN), c'est à dire son nom absolu (commençant par `\`).

```php
<?php
    $mainController = new \NomDuProjet\Controllers\MainController();
?>
```

### #4 - Créer un raccourci pour l'utilisation des classes

Si on ne souhaite pas utiliser le FQCN à chaque utilisation d'une classe, on peut dire à PHP quelle classe on veut utiliser au début du fichier.

On peut également faire un alias pour une classe avec le mot clé `as`.

```php
<?php
    
use NomDuProjet\Controllers\MainController;
// Possibilité de faire un alias
use NomDuProjet\Controllers\ErrorController as ErrController;

// ici, PHP va faire $mainController = new \NomDuProjet\Controllers\MainController();
$mainController = new MainController();
// ici, PHP va faire $errorController = new \NomDuProjet\Controllers\ErrorController();
$errorController = new ErrController();
```

### #5 - Cas des classes natives ou des classes sans namespace

Les classes natives de PHP (comme DateTime ou PDO) ou les classes qui ne sont pas rangées dans un namespace (comme AltoRouter) sont situées à la racine globale dans namespaces qui est : `\`

Donc pour les utiliser, par exemple, le FQCN de `DateTime` (classe native de PHP) est `\DateTime`.