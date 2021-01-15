<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * TempsController.php
 * 
 * Controller of the 'Temps' entity with CRUD's functions.
 */

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
     * @Route("temps/read/all", name="temps_readAll")
     * 
     * readAll()
     * 
     * Function for display all entries from "Temps" by a twig.
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
     * 
     * read($id)
     *
     * Function for display the entry where the id is specified and exist from "Temps" by a twig.
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
     * 
     * readSelector()
     *
     * Function for redirect to the twig of read selector's choice of "Temps".
     */

    public function readSelector()
    {
        return $this->render('temps/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "temps",
        ]);
    }

    /**
     * @Route("temps/edit/check/{id}", name="temps_edit_check", methods={"GET", "POST"})
     * 
     * checkEditAvailable($id)
     * 
     * Function for make a redirection to the edition page if the specified entry from "Temps" exist.
     */

    public function checkEditAvailable($id)
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

        header('Location: http://localhost:8000/temps/edit/'.$id);
        exit();
    }

    /**
     * @Route("temps/edit/{id}", name="temps_edit", methods={"GET", "POST"})
     * 
     * edit(Request $request, Profondeur $profondeur)
     * 
     * Function for make an edition of an entry from "Temps" by a twig.
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
     * 
     * editSelector()
     *
     * Function for redirect to the twig of edit selector's choice of "Temps".
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
     * 
     * new(Request $request)
     *
     * Function for create a new "Temps" entry.
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
     * 
     * delete($id)
     *
     * Function for delete a specified "Temps" entry.
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
     * 
     * deleteSelector()
     *
     * Function for redirect to the twig of delete selector's choice of "Temps".
     */

    public function deleteSelector()
    {
        return $this->render('temps/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "temps",
        ]);
    }
}
