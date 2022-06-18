<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Animal;
use App\Entity\Breed;
use App\Entity\Piece;
use App\Entity\Producer;
use App\Entity\Specie;

use DateTimeImmutable;

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
       
       // Instaciation de l'usine de Faker
       $faker = Faker\Factory::create('fr_FR');

               // Breed;
        //Création de 20 races différentes
        $breedsList=[];

        for ($j=1;$j<21;$j++) {
            //je crée un instance de Breed
            $breed = new Breed;
            //name
            $breed->setName($faker->name());
            //picture
            $breed->setPicture('App/doc/'.$faker->name().'.png') ;
            //advantage
            $breed->setAdvantage($faker->realText(250));
            //je rentre cette instance dans le tableau
            $breedsList[]= $breed;
            //je prépare l'insertion
            $manager->persist($breed);
        }

       //Création de 50 items de la Table Animal
       $animalsList=[];

       for ($i=1;$i<51;$i++){

            // créeation nouvelle instance Animal
           $animal= new Animal;
           //name
           $animal->setName($faker->name()) ;
           //picture
           $animal->setPicture('App/doc/'.$faker->name().'.png') ;
           //description
           $animal->setDescription('App/doc/'.$faker->name().'.png') ;
           //healthsheet
           $animal->setHealthSheet($faker->name()) ;
           //birthdate
           $birthdate = new DateTimeImmutable($faker->date());
           $animal->setBirthdate( $birthdate) ;
           //slaughter_date
           $slaughter =new DateTimeImmutable($faker->date());
           $animal->setSlaughterDate($slaughter) ;
           //producer
           $animal->setBreed($breedsList[ mt_rand(0, count($breedsList) - 1)]);
           //breed
           //ajout de cette instance dans le tableau
           $animalsList[] = $animal;
           //préparation pour envoi à la bdd
           $manager->persist($animal);
       }
    
 
        
       //j'envoi la requete à la base de donnée
        $manager->flush();
    }
}
