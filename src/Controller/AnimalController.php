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

//Pour interagir avec notre Formulaire Animal
use App\Form\AnimalFormType;

// Pour interagir avec notre Entité Animal

use App\Entity\Breed;
use App\Entity\Animal;
use App\Entity\Producer;
use App\Entity\User;
use App\Repository\PieceRepository;
use DateTimeImmutable;
use Symfony\Component\Form\Forms;

//Pour donner des autorisation dans les annotations des méthodes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AnimalController extends AbstractController
{
   
    
    /**
     * affiche la liste des articles de la table "Animal"
     * 
     *  @Route("/", name="home", methods={"GET"})
     * @Route("/animal", name="animal_list", methods={"GET"})
     */
    public function index(AnimalRepository $animalRepository): Response
    {
        
        
    

        return $this->render('animal/index.html.twig', [
            'listAnimal' => $animalRepository->findAll(),
        ]);
    }


    /**
     * affiche un élément de la table "Animal"
     * 
     * Animal show
     * 
     * @Route("/animal/{id}", name="animal-show", requirements={"id"="\d+"})
     */
    public function show($id, ManagerRegistry $doctrine, PieceRepository $pieceRepository)
    {
        // Alternative pour accéder au Repository de l'entité Animal
        $animalRepository = $doctrine->getRepository(Animal::class);

        $animal = $animalRepository->find($id);

        // Post not found ?
        if ($animal === null) {
            throw $this->createNotFoundException('Animal non trouvé.');
        }
        //liste des pièces de cette animal
        $piecesList = $pieceRepository->findByAnimalId($id);
       
        //$breed = $animal->getBreed();
        //var_dump($breed);
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'piecesList'=> $piecesList,
        ]);
    }

    /**
     * @Route("/animal/add", name="animal-add", methods={"POST","GET"})
     *      
     *@IsGranted("ROLE_MANAGER")
     * @return Response
     */
    public function add ( ManagerRegistry $doctrine, Request $request, AnimalRepository $animalRepository): Response
    {
            

          //TODO: $this->denyAccessUnlessGranted('MOVIE_EDIT_1400', $user);

            $newAnimal = new Animal();
            $form = $this->createForm(AnimalFormType::class,$newAnimal);
           // dd($form);
           // récupération de la réponse
           $form->handleRequest($request);

           // si le formulaire a été soumis et que les données sont valides
           if($form->isSubmitted() && $form->isValid())
           {
                $animalRepository->add($newAnimal, true);
                //dd($newAnimal);
                      $this->addFlash(
                'success', // la "catégorie" de message
                'Votre animal a bien été ajouté' // le texte à afficher
                // redirection vers la page movieShow
              
            );
            return $this->redirectToRoute('home');
           }        
        return $this->renderForm('animal/add.html.twig',
                [
                    'form' => $form
                ] 
            );
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
     * @Route("/animal/delete/{id}", name="animal-delete", requirements={"id"="\d+"}, methods={"GET", "POST"})
     */
    public function delete($id, AnimalRepository $postRepository, ManagerRegistry $doctrine)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        // On va chercher l'enregistrement
        $post = $postRepository->find($id);

        // Post not found ?
        if ($post === null) {
            throw $this->createNotFoundException('Article non trouvé.');
        }

        // On modifie la date de mise à jour à la date actuelle
        //$post->setUpdatedAt(new DateTimeImmutable());

        // On le met à jour via le Manager
        $entityManager = $doctrine->getManager();
        // Exécute la requête d'UPDATE
        $entityManager->flush();

        return $this->render('animal/wip.html.twig');
    }
}
