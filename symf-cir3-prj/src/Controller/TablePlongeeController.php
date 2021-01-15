<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * TablePlongeeController.php
 * 
 * Controler of the 'TablePlongee' entity with CRUD's functions.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\TablePlongee;
use App\Entity\Profondeur;
use App\Entity\Temps;

use App\Form\TablePlongeeType;
use Symfony\Component\HttpFoundation\Request;


class TablePlongeeController extends AbstractController
{
    /**
     * @Route("table_plongee/read/all", name="table_plongee_readAll")
     * 
     * readAll()
     * 
     * Function for display all entries from "TablePlongee" by a twig.
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
     * 
     * read($id)
     *
     * Function for display the entry where the id is specified and exist from "TablePlongee" by a twig.
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
     *
     * readSelector()
     *
     * Function for redirect to the twig of read selector's choice of "TablePlongee".
     */

    public function readSelector()
    {
        return $this->render('table_plongee/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "table_plongee",
        ]);
    }

/**
     * @Route("table_plongee/edit/check/{id}", name="table_plongee_edit_check", methods={"GET", "POST"})
     * 
     * checkEditAvailable($id)
     * 
     * Function for make a redirection to the edition page if the specified entry from "TablePlongee" exist.
     */

    public function checkEditAvailable($id)
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

        header('Location: http://localhost:8000/table_plongee/edit/'.$id);
        exit();
    }

    /**
     * @Route("table_plongee/edit/{id}", name="table_plongee_edit", methods={"GET", "POST"})
     * 
     * edit(Request $request, TablePlongee $table_plongee)
     * 
     * Function for make an edition of an entry from "TablePlongee" by a twig.
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
     * 
     * editSelector()
     *
     * Function for redirect to the twig of edit selector's choice of "TablePlongee".
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
     *
     * new(Request $request)
     *
     * Function for create a new "TablePlongee" entry.
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
     * 
     * delete($id)
     *
     * Function for delete a specified "TablePlongee" entry.
     */

    public function delete($id)
    {
        // Delete "Profondeur" entries where they're attached to the "TablePlongee" entry to detele.
        $profondeurs = $this->getDoctrine()
                    ->getRepository(Profondeur::class)
                    ->findBy(['correspond' => $id]);
        if (!$profondeurs)
        {
            return $this->render('error.html.twig', [
                'message' => "No datas found for ID ".$id
            ]);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $profondeurs_size = count($profondeurs);

        for ($profondeurs_indice = 0 ; $profondeurs_indice < $profondeurs_size ; ++$profondeurs_indice)
        {
            $profondeur_id = $profondeurs[$profondeurs_indice];
            
            // Delete "Temps" entries where they're attached to the "Profondeur" entries to detele.
            $tempss = $this->getDoctrine()
                    ->getRepository(Temps::class)
                    ->findBy(['est_a' => $profondeur_id]);
            $tempss_size = count($tempss);
            for ($tempss_indice = 0 ; $tempss_indice < $tempss_size ; ++$tempss_indice)
            {
                $entityManager->remove($tempss[$tempss_indice]);
            }

            $entityManager->remove($profondeurs[$profondeurs_indice]);
        }
        
        $entityManager->flush();

        // Delete the specified "TablePlongee" entry.
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
        $entityManager->remove($table_plongee);
        $entityManager->flush();

        return $this->render('table_plongee/delete.html.twig', [
            'id' => $removedId
        ]);
    }
    
    /**
     * @Route("table_plongee/delete/", name="table_plongee_delete_selector")
     * 
     * deleteSelector()
     *
     * Function for redirect to the twig of delete selector's choice of "TablePlongee".
     */

    public function deleteSelector()
    {
        return $this->render('table_plongee/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "table_plongee",
        ]);
    }
}