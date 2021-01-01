<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Temps;
use App\Form\TempsType;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("temps/read/all", name="temps_readAll")
     */

    public function readAll()
    {
        $tempss = $this->getDoctrine()
                        ->getRepository(Temps::class)
                        ->findAll();
        
        return $this->render('temps/readAll.html.twig', [
            'tempss' => $tempss,
        ]);
    }

    /**
     * @Route("temps/read/{id}", name="temps_read")
     */

    public function read($id)
    {
        $temps = $this->getDoctrine()
                        ->getRepository(Temps::class)
                        ->find($id);
        
        if (!$temps)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }

        return $this->render('temps/read.html.twig', [
            'temps' => $temps,
        ]);
    }

    /**
    * @Route("temps/read/", name="temps_read_selector")
    */

    public function readSelector()
    {
        return $this->render('temps/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "temps",
        ]);
    }

    /**
    * @Route("temps/edit/{id}", name="temps_edit", methods={"GET", "POST"})
    */

    public function edit(Request $request, Temps $temps)
    {   
        $form = $this->createForm(TempsType::class, $temps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('temps_readAll');
        }

        return $this->render('temps/edit.html.twig', [
            'temps' => $temps,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("temps/edit/", name="temps_edit_selector")
     */

    public function editSelector()
    {
        return $this->render('temps/selector.html.twig', [
            'crud_method' => "edit",
            'entity' => "temps",
        ]);
    }

    /**
    * @Route("temps/new", name="temps_new", methods={"GET","POST"})
    */
    
    public function new(Request $request): Response
    {
        $temps = new Temps();
        $form = $this->createForm(TempsType::class, $temps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($temps);
            $entityManager->flush();
            return $this->redirectToRoute('temps_readAll');
        }

        return $this->render('temps/new.html.twig', [
            'temps' => $temps,
            'form' => $form->createView(),
            ]);       
    }

    /**
     * @Route("temps/delete/{id}", name="temps_delete")
     */

    public function delete($id)
    {
        $temps = $this->getDoctrine()
                        ->getRepository(Temps::class)
                        ->find($id);
        if (!$temps)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }
        $removedId = $temps->getId();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($temps);
        $entityManager->flush();

        return $this->render('temps/delete.html.twig', [
            'id' => $removedId
        ]);
    }
    
    /**
    * @Route("temps/delete/", name="temps_delete_selector")
    */

    public function deleteSelector()
    {
        return $this->render('temps/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "temps",
        ]);
    }
    

}
