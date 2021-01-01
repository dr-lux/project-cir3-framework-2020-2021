<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\TablePlongee;
use App\Form\TablePlongeeType;
use Symfony\Component\HttpFoundation\Request;


class TablePlongeeController extends AbstractController
{
    /**
     * @Route("table_plongee/read/all", name="table_plongee_readAll")
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

    /**
     * @Route("table_plongee/read/{id}", name="table_plongee_read")
     */

    public function read($id)
    {
        $table_plongee = $this->getDoctrine()
                        ->getRepository(TablePlongee::class)
                        ->find($id);
        
        if (!$table_plongee)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }

        return $this->render('table_plongee/read.html.twig', [
            'table_plongee' => $table_plongee,
        ]);
    }

    /**
    * @Route("table_plongee/read/", name="table_plongee_read_selector")
    */

    public function readSelector()
    {
        return $this->render('table_plongee/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "table_plongee",
        ]);
    }

    /**
     * @Route("table_plongee/edit/{id}", name="table_plongee_edit", methods={"GET", "POST"})
     */

    public function edit(Request $request, TablePlongee $table_plongee)
    {
        $form = $this->createForm(TablePlongeeType::class, $table_plongee);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('table_plongee_readAll');
        }

        return $this->render('table_plongee/edit.html.twig', [
            'table_plongee' => $table_plongee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("table_plongee/edit/", name="table_plongee_edit_selector")
     */

    public function editSelector()
    {
        return $this->render('table_plongee/selector.html.twig', [
            'crud_method' => "edit",
            'entity' => "table_plongee",
        ]);
    }

    /**
    * @Route("table_plongee/new", name="table_plongee_new", methods={"GET","POST"})
    */
    
    public function new(Request $request): Response
    {
        $table_plongee = new TablePlongee();
        $form = $this->createForm(TablePlongeeType::class, $table_plongee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($table_plongee);
            $entityManager->flush();
            return $this->redirectToRoute('table_plongee_readAll');
        }

        return $this->render('table_plongee/new.html.twig', [
            'table_plongee' => $table_plongee,
            'form' => $form->createView(),
            ]);       
    }

    /**
     * @Route("table_plongee/delete/{id}", name="table_plongee_delete")
     */

    public function delete($id)
    {
        $table_plongee = $this->getDoctrine()
                        ->getRepository(TablePlongee::class)
                        ->find($id);
        if (!$table_plongee)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }
        $removedId = $table_plongee->getId();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($table_plongee);
        $entityManager->flush();

        return $this->render('table_plongee/delete.html.twig', [
            'id' => $removedId
        ]);
    }
    
    /**
    * @Route("table_plongee/delete/", name="table_plongee_delete_selector")
    */

    public function deleteSelector()
    {
        return $this->render('table_plongee/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "table_plongee",
        ]);
    }
}