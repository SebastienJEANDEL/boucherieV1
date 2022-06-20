<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Pour utiliser le AnimalRepository
use App\Repository\AnimalRepository;

// Pour interagir avec notre BDD
use Doctrine\Persistence\ManagerRegistry;

// Pour récupérer les informations de la requête HTTP
use Symfony\Component\HttpFoundation\Request;

// Pour interagir avec notre Entité Animal

use App\Entity\Breed;
use App\Entity\Animal;
use App\Entity\Producer;
use DateTimeImmutable;

class AnimalController extends AbstractController
{
    /**
     * affiche la liste des articles de la table "Animal"
     * 
     * @Route("/animal", name="animal_list", methods={"POST","GET"})
     */
    public function index(AnimalRepository $animalRepository, Request $request): Response
    {
        if ($request->isMethod('POST')) {
            dd('coucou');
        }
        $listAnimal = $animalRepository->findAll();

        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
            'listAnimal' => $listAnimal
        ]);
    }


    /**
     * affiche un élément de la table "Animal"
     * 
     * Animal show
     * 
     * @Route("/animal/{id}", name="animal-show", requirements={"id"="\d+"})
     */
    public function show($id, ManagerRegistry $doctrine)
    {
        // Alternative pour accéder au Repository de l'entité Animal
        $animalRepository = $doctrine->getRepository(Animal::class);

        $animal = $animalRepository->find($id);

        // Post not found ?
        if ($animal === null) {
            throw $this->createNotFoundException('Animal non trouvé.');
        }
        //$breed = $animal->getBreed();
        //var_dump($breed);
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    /**
     * @Route("/animal/add", name="animal-add", methods={"POST","GET"})
     * 
     * @todo faire les vérifications des données récupérées après soumission du formulaire
     *
     * @return Response
     */
    public function add (ManagerRegistry $doctrine, Request $request): Response
    {
        
        // Si cette méthode est exécutée dans l'url /post/add est appelée en méthode POST
        // C'est que le formulaire d'ajout a été soumis
        if ($request->isMethod('POST')) {
           // dd($request);
            // On va pouvoir récupérer les données saisies, et créer une nouvelle instance de l'entité POST
            $newAnimal = new Animal();

            // Name
            $name = $request->request->get('name');
            $newAnimal->setName( $name );

            // Picture
            $newAnimal->setPicture($request->request->get('picture'));

            // Description  
            $newAnimal->setDescription($request->request->get('description'));
            // Health_sheet
            $newAnimal->setHealthSheet($request->request->get('healthSheet'));
            // Birthdate
            $birthDate = new \DateTimeImmutable($request->request->get('birthDate'));
            $newAnimal->setBirthdate($birthDate);
            // Slaughter_date    
            $slaughterDate = new \DateTimeImmutable($request->request->get('slaughterDate'));
            $newAnimal->setSlaughterDate($slaughterDate); 
            // Producer
            $producer= new Producer;
            $producer->setName($request->request->get('producer'));
            $newAnimal->setProducer($producer);
            //Breed  
            $breed = new Breed;  
            $breed->setName($request->request->get('breed')) ;
            $newAnimal->setBreed($breed);
           
            //dd($newAnimal);

            // Maintenant on peut aller chercher l'entity manager
            $entityManager = $doctrine->getManager();
            // Prépare-toi à "persister" notre objet (req. INSERT INTO)
            $entityManager->persist($newAnimal);

            // Avant de l'enregistrer en BDD
            $entityManager->flush();


            //dd($newPost);
            // https://symfony.com/doc/5.4/components/http_foundation/sessions.html#flash-messages
            // https://symfony.com/doc/5.4/controller.html#flash-messages
            // On veut garder en session un message pour informer l'utilisateur que son article a bien été sauvegardé :
            $this->addFlash(
                'success', // la "catégorie" de message
                'Votre animal a bien été ajouté' // le texte à afficher
            );

            $this->addFlash(
                'warning', // la "catégorie" de message
                'Mais il faut vérifier que les champs producer_id et breed_id contienne bien des id' // le texte à afficher
            );

            // redirection vers la liste des articles
            return $this->redirectToRoute('animal');
        }
        
        return $this->render('animal/add.html.twig');
    }

    /**
     * @Route("/filterByBreed/{id}", name="filter-breed" ,methods={"GET"}, requirements={"id"="\d+"})
     * 
     * @return Response
     */
    public function filterByBreedId(int $id,AnimalRepository $animalRepository): Response
    {
        $animalsList = $animalRepository->findAllAnimalsByBreed($id);
        
        // On transmet à notre vue la liste des animaux
        return $this->render(
            'animal/index.html.twig',
            ["listAnimal" => $animalsList]
        );
    }


     /**
     * Post delete
     * 
     * @Route("/animal/delete/{id}", name="animal-delete", requirements={"id"="\d+"})
     */
    public function delete($id, AnimalRepository $postRepository, ManagerRegistry $doctrine)
    {
        // On va chercher l'enregistrement
        $post = $postRepository->find($id);

        // Post not found ?
        if ($post === null) {
            throw $this->createNotFoundException('Article non trouvé.');
        }

        // On demande au Manager de le supprimer
        $entityManager = $doctrine->getManager();
        $entityManager->remove($post);
        // Exécute la requête de DELETE
        $entityManager->flush();

        return $this->redirectToRoute('app_post');
    }

    /**
     * Post update
     * 
     * @Route("/post/update/{id}", name="animal-update", requirements={"id"="\d+"})
     */
    public function update($id, AnimalRepository $postRepository, ManagerRegistry $doctrine)
    {
        // On va chercher l'enregistrement
        $post = $postRepository->find($id);

        // Post not found ?
        if ($post === null) {
            throw $this->createNotFoundException('Article non trouvé.');
        }

        // On modifie la date de mise à jour à la date actuelle
        $post->setUpdatedAt(new DateTimeImmutable());

        // On le met à jour via le Manager
        $entityManager = $doctrine->getManager();
        // Exécute la requête d'UPDATE
        $entityManager->flush();

        return $this->redirectToRoute('app_post');
    }
}
