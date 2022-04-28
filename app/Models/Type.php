<?php

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

class Type extends CoreModel
{
    /**
     * Get all types
     *
     * @return Type[]
     */
    public function findAll()
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `type`';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        // $typesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, '\Oshop\Models\Type');
        // Type::class nous donne le FQCN de la classe Type => \Oshop\Models\Type
        // self::class nous donne le FQCN de la classe dans laquelle on se trouve
        // __CLASS__ nous donne également le FQCN de la classe dans laquelle on se trouve
        // $typesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Type::class);
        // $typesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, __CLASS__);
        $typesList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // On retourne le résultat
        return $typesList;
    }

    /**
     * Get a type from an id
     *
     * @return Type
     */
    public function find($id)
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `type` WHERE `id` = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        $type = $pdoStatement->fetchObject(self::class);

        // On retourne le résultat
        return $type;
    }
    public function findHomeTypes()
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * 
                FROM `type`
               ';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);
        
        // Récupération du résultat
        $typesListForHome = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // Retourner le résultat
        return  $typesListForHome;
    }
} 