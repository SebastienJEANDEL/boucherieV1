<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

// Une classe "Model" permet de définir le plan de fabrication
// permettant de réprésenter une marque dont les informations
// seront issues de la table 'brand'
class Brand extends CoreModel
{
    /**
     * Get all brands
     *
     * @return Brand[]
     */
    public function findAll()
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `brand`';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        $brandsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // On retourne le résultat
        return $brandsList;
    }

    /**
     * Get a brand from an id
     *
     * @return Brand
     */
    public function find($id)
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `brand` WHERE `id` = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        $brand = $pdoStatement->fetchObject(self::class);

        // On retourne le résultat
        return $brand;
    }
}