<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TablePlongeeController extends AbstractController
{
    /**
     * @Route("/table/plongee", name="table_plongee")
     */
    public function index(): Response
    {
        return $this->render('table_plongee/index.html.twig', [
            'controller_name' => 'TablePlongeeController',
        ]);
    }

    /**
     * @Route("/all", name="table_plongee_readAll")
     */

    public function readAll()
    {
        $tables_plongee = $this->getDoctrine()
                        ->getRepository(TablePlongee::class)
                        ->findAll();
        
        return $this->render('table_plongee/readAll.html.twig', [
            'tables_plongee' => $tables_plongee,
        ]);
    }
}
