<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Animal;
use App\Entity\Breed;
use App\Entity\Piece;
use App\Entity\Producer;
use App\Entity\Specie;

use Faker;

use Doctrine\DBAL\Connection;

class AppFixtures extends Fixture
{
    // On y stockera notre objet de connexion à la BDD
    private $connection;
    
     public function __construct(Connection $connection)
    {
        // On récupère la connexion à la BDD (DBAL ~= PDO)
        // pour exécuter des requêtes manuelles en SQL pur
        $this->connection = $connection;
    }

     /**
     * Permet de TRUNCATE les tables et de remettre les Auto-incréments à 1
     */
    private function truncate()
    {
        // On passe en mode SQL ! On cause avec MySQL
        // Désactivation la vérification des contraintes FK
        $this->connection->executeQuery('SET foreign_key_checks = 0');
        // On tronque
        $this->connection->executeQuery('TRUNCATE TABLE animal');
        $this->connection->executeQuery('TRUNCATE TABLE breed');
        $this->connection->executeQuery('TRUNCATE TABLE piece');
        $this->connection->executeQuery('TRUNCATE TABLE producer');
        $this->connection->executeQuery('TRUNCATE TABLE producer_breed');
        $this->connection->executeQuery('TRUNCATE TABLE specie');
        // etc.
        // Réactivation la vérification des contraintes FK
        $this->connection->executeQuery('SET foreign_key_checks = 1');
    }


    /**
    * Méthode exécutée lorsqu'on tape la commande : 
    * php bin/console doctrine:fixtures:load
    *
    * @param ObjectManager $manager
    * @return void
    */
    public function load(ObjectManager $manager): void
    {
       //! d'abord, on vide les tables de leurs données
       $this->truncate();
        var_dump("coucou");
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
