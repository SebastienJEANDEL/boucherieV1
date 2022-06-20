<?php
//methode animal add sans Symfo Form

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
 