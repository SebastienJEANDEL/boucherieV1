<?php 

namespace Oshop\Models;

use Oshop\Utils\Database;
use PDO;

class Product extends CoreModel
{
    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */ 
    public function setDescription($description)
    {
        $this->description = $description;
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
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */ 
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     */ 
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */ 
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of brand_id
     */ 
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     */ 
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */ 
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     */ 
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     */ 
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
    }

    /**
     * Get all products
     *
     * @return Product[]
     */
    public function findAll()
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `product`';

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        $productsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // On retourne le résultat
        return $productsList;
    }

    /**
     * Get a product from an id
     *
     * @return Product
     */
    public function find($id)
    {
        // On récupère la connexion PDO
        $pdoDBConnexion = Database::getPDO();

        // On écrit notre requête SQL
        $sql = 'SELECT * FROM `product` WHERE `id` = ' . $id;

        // On exécute la requête
        $pdoStatement = $pdoDBConnexion->query($sql);

        // On récupère les données
        $product = $pdoStatement->fetchObject(self::class);

        // On retourne le résultat
        return $product;
    }

    /**
     * Récupère la liste des produits d'une catégorie donnée à partir
     * d'un id de catégorie
     * On récupère également le nom du type de produit de chaque produit.
     *
     * @param int $categoryId
     * 
     * @return array
     */
    public function findProductsWithTypeNameByCategoryId($categoryId)
    {
        $pdoDBConnexion = Database::getPDO();

        $sql = 'SELECT `product`.*, `type`.`name` AS `type_name`
        FROM `product`
        INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
        WHERE `product`.`category_id` = ' . $categoryId;

        $pdoStatement = $pdoDBConnexion->query($sql);

        $productsListWithTypeName = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $productsListWithTypeName;
    }

    /**
     * Récupère la liste des produits d'un type donné
     *
     * @param int $id L'id du type dont on veut récupérer les produits
     * 
     * @return Product[]
     */
    public function findProductsByTypeId($id)
    {
        $pdoDBConnexion = Database::getPDO();

        $sql = '
            SELECT *
            FROM `product`
            WHERE `type_id` = '. $id;

        $pdoStatement = $pdoDBConnexion->query($sql);

        $productsList = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $productsList;
    }

    /**
     * Récupère la liste des produits d'une marque donnée à partir
     * d'un id de la marque.
     * On récupère également le nom du type de produit de chaque produit.
     * 
     * @param int $id The brand id
     *
     * @return array
     */
    public function findProductsWithTypeNameByBrandId($id)
    {
        $pdoDBConnexion = Database::getPDO();

        $sql = 'SELECT `product`.*, `type`.`name` AS `type_name`
                FROM `product`
                INNER JOIN `type` ON `product`.`type_id` = `type`.`id`
                WHERE `brand_id` = ' . $id;

        $pdoStatement = $pdoDBConnexion->query($sql);

        $productsListWithTypeName = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $productsListWithTypeName;
    }
} 