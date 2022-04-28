<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

class Category extends CoreModel
{
    private $subtitle;
    private $picture;
    private $home_order;

    /**
     * Get the value of subtitle
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     */
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

    /**
     * Get all categories
     *
     * @return Category[]
     */
    public function findAll()
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `category`';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        // Avec l'option PDO::FETCH_CLASS, on indique à PDO de nous donner
        // les résultats sous formes d'objets issus de la classe Category.
        // Le nom de la classe utilisé pour créer les objets est à fournir
        // en 2ème argument du fetchAll.
        $categoriesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // On retourne le résultat
        return $categoriesList;
    }

    /**
     * Get a category from an id
     *
     * @return Category
     */
    public function find($id)
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `category` WHERE `id` = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        // fetchObject recupère un seul résultat et crée un objet
        // de la classe passée en argument.
        $category = $pdoStatement->fetchObject(self::class);

        // On retourne le résultat
        return $category;
    }

    /**
     * Méthode qui récupère les 5 catégories mises en avant sur la page
     * d'accueil
     */
    public function findHomeCategories()
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * 
                FROM category
                WHERE home_order > 0
                ORDER BY home_order ASC
                LIMIT 5';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);
        
        // Récupération du résultat
        $categoriesListForHome = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // Retourner le résultat
        return $categoriesListForHome;
    }
}
