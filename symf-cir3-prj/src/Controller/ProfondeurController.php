<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Profondeur;
use App\Form\ProfondeurType;
use Symfony\Component\HttpFoundation\Request;

class ProfondeurController extends AbstractController
{
    /**
     * @Route("profondeur/read/all", name="profondeur_readAll")
     */

    public function readAll()
    {
        $profondeurs = $this->getDoctrine()
                        ->getRepository(Profondeur::class)
                        ->findAll();
        
        return $this->render('profondeur/readAll.html.twig', [
            'profondeurs' => $profondeurs,
        ]);
    }

    /**
     * @Route("profondeur/read/{id}", name="profondeur_read")
     */

    public function read($id)
    {
        $profondeur = $this->getDoctrine()
                        ->getRepository(Profondeur::class)
                        ->find($id);
        
        if (!$profondeur)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }

        return $this->render('profondeur/read.html.twig', [
            'profondeur' => $profondeur,
        ]);
    }

    /**
    * @Route("profondeur/read/", name="profondeur_read_selector")
    */

    public function readSelector()
    {
        return $this->render('profondeur/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "profondeur",
        ]);
    }

    /**
    * @Route("profondeur/edit/{id}", name="pronfondeur_edit", methods={"GET", "POST"})
    */

    public function edit(Request $request, Profondeur $profondeur)
    {
        $form = $this->createForm(ProfondeurType::class, $profondeur);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('profondeur_readAll');
        }

        return $this->render('profondeur/edit.html.twig', [
            'profondeur' => $profondeur,
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("profondeur/edit/", name="profondeur_edit_selector")
    */

    public function editSelector()
    {
        return $this->render('profondeur/selector.html.twig', [
            'crud_method' => "edit",
            'entity' => "profondeur",
        ]);
    }

    /**
    * @Route("profondeur/new", name="profondeur_new", methods={"GET","POST"})
    */
    
    public function new(Request $request): Response
    {
        $profondeur = new Profondeur();
        $form = $this->createForm(ProfondeurType::class, $profondeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profondeur);
            $entityManager->flush();
            return $this->redirectToRoute('profondeur_readAll');
        }

        return $this->render('profondeur/new.html.twig', [
            'profondeur' => $profondeur,
            'form' => $form->createView(),
            ]);       
    }

    /**
     * @Route("profondeur/delete/{id}", name="profondeur_delete")
     */

    public function delete($id)
    {
        $profondeur = $this->getDoctrine()
                        ->getRepository(Profondeur::class)
                        ->find($id);
        if (!$profondeur)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }
        $removedId = $profondeur->getId();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($profondeur);
        $entityManager->flush();

        return $this->render('profondeur/delete.html.twig', [
            'id' => $removedId
        ]);
    }

    /**
    * @Route("profondeur/delete/", name="profondeur_delete_selector")
    */

    public function deleteSelector()
    {
        return $this->render('profondeur/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "profondeur",
        ]);
    }
}
