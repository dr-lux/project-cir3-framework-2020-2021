<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TempsController extends AbstractController
{
    /**
     * @Route("/temps", name="temps")
     */
    public function index(): Response
    {
        return $this->render('temps/index.html.twig', [
            'controller_name' => 'TempsController',
        ]);
    }
}
