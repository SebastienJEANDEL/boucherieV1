<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
