<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SpecieController extends AbstractController
{
    /**
     * @Route("/specie", name="app_specie")
     */
    public function index(): Response
    {
        return $this->render('specie/index.html.twig', [
            'controller_name' => 'SpecieController',
        ]);
    }
}
