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

// Pour interagir avec notre Entité Post
use App\Entity\Animal;
use DateTimeImmutable;

class AnimalController extends AbstractController
{
    /**
     * affiche la liste des articles de la table "Animal"
     * 
     * @Route("/animal", name="animal_list")
     */
    public function index(AnimalRepository $animalRepository): Response
    {
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
            // On va pouvoir récupérer les données saisies, et créer une nouvelle instance de l'entité POST
            $newAnimal = new Animal();

            // Name
            $title = $request->request->get('title');
            $newAnimal->setTitle( $title );

            // Picture
            $newAnimal->setBody($request->request->get('body'));

            // Description  
            // Health_sheet
            // Birthdate
            // Slaughter_date          

            //https://www.php.net/manual/fr/class.datetimeimmutable.php
            // la classe DateTimeImmutable nous vient de PHP, donc pour son FQCN, on met juste un antislash devant
            $publishedDate = new \Date($request->request->get('published_at'));
            // Nous sommes obligés de créer une instance de DateTimeImmutable pour remplir la propriété publishedAt du nouvel article
            $newAnimal->setPublishedAt($publishedDate);

            // De même pour la date de création
            // Sans argument, cela crée une instance DateTimeImmutable de "maintenant"
            /* $createdDate = new \DateTimeImmutable();
            $newPost->setCreatedAt($createdDate); */
            // ! Plus besoin, maintenant, ça se fait directement dans le constructeur de l'entité Post

            //dump($newPost);

            // Maintenant on peut aller chercher l'entity manager
            $entityManager = $doctrine->getManager();
            // Prépare-toi à "persister" notre objet (req. INSERT INTO)
            $entityManager->persist($newPost);

            // Avant de l'enregistrer en BDD
            $entityManager->flush();


            //dd($newPost);
            // https://symfony.com/doc/5.4/components/http_foundation/sessions.html#flash-messages
            // https://symfony.com/doc/5.4/controller.html#flash-messages
            // On veut garder en session un message pour informer l'utilisateur que son article a bien été sauvegardé :
            $this->addFlash(
                'success', // la "catégorie" de message
                'Votre article a bien été ajouté' // le texte à afficher
            );

            $this->addFlash(
                'warning', // la "catégorie" de message
                'Mais il faut le faire relire par un autre rédacteur' // le texte à afficher
            );

            // redirection vers la liste des articles
            return $this->redirectToRoute('app_post');
        }
        
        return $this->render('post/add.html.twig');
    }


     /**
     * Post delete
     * 
     * @Route("/post/delete/{id}", name="app_post-delete", requirements={"id"="\d+"})
     */
    public function delete($id, PostRepository $postRepository, ManagerRegistry $doctrine)
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
     * @Route("/post/update/{id}", name="app_post-update", requirements={"id"="\d+"})
     */
    public function update($id, PostRepository $postRepository, ManagerRegistry $doctrine)
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
