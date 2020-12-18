<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfondeurController extends AbstractController
{
    /**
     * @Route("/profondeur", name="profondeur")
     */
    public function index(): Response
    {
        return $this->render('profondeur/index.html.twig', [
            'controller_name' => 'ProfondeurController',
        ]);
    }
}
