<?php

namespace App\Controller;

use App\Entity\Piece;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\AutoCountVue;
use Doctrine\Persistence\ManagerRegistry;

class PieceController extends AbstractController
{
    /**
     * @Route("/piece", name="app_piece")
     */
    public function index(): Response
    {
        return $this->render('piece/index.html.twig', [
            'controller_name' => 'PieceController',
        ]);
    }
     /**
     * affiche un élément de la table "Piece"
     * 
     * Piece show    
     * @Route("/piece/{id}", name="piece-show", requirements={"id"="\d+"})
     */
    public function show(Piece $piece, AutoCountVue $autoCountVue, ManagerRegistry $registry): Response
    {
        
        $piece= $piece->setCompteurVue($autoCountVue->incrementVue($piece));

        $em = $registry->getManager();
        $em->persist($piece);
        $em->flush();               

        return $this->render('piece/show.html.twig', [
            'piece' => $piece,
        ]);
    }

}
