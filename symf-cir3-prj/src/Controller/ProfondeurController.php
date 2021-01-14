<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * ProfondeurController.php
 * 
 * Controler of the 'Profondeur' entity with CRUD's functions.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Profondeur;
use App\Entity\Temps;

use App\Form\ProfondeurType;
use Symfony\Component\HttpFoundation\Request;

class ProfondeurController extends AbstractController
{
    /**
     * @Route("profondeur/read/all", name="profondeur_readAll")
    */

    // /**
    //  * readAll()
    //  * 
    //  * Function for display all entries from "Profondeur" by a twig.
    // */
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

    // /**
    //  * read($id)
    //  *
    //  * Function for display the entry where the id is specified and exist from "Profondeur" by a twig.
    //  */
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

    // /**
    //  * readSelector()
    //  *
    //  * Function for redirect to the twig of read selector's choice of "Profondeur".
    //  */
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

    // /**
    //  * edit(Request $request, Profondeur $profondeur)
    //  * 
    //  * Function for make an edition of an entry from "Profondeur" by a twig.
    //  */
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

    // /**
    //  * editSelector()
    //  *
    //  * Function for redirect to the twig of edit selector's choice of "Profondeur".
    //  */
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
    
    // /**
    //  * new(Request $request)
    //  *
    //  * Function for create a new "Profondeur" entry.
    //  */
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

    // /**
    //  * delete($id)
    //  *
    //  * Function for delete a specified "Profondeur" entry.
    //  */
    public function delete($id)
    {
        // Delete "Temps" entries where they're attached to the "Profondeur" entries to detele.
        $tempss = $this->getDoctrine()
                    ->getRepository(Temps::class)
                    ->findBy(['est_a' => $id]);
        $tempss_size = count($tempss);
        $entityManager = $this->getDoctrine()->getManager();

        for ($tempss_indice = 0 ; $tempss_indice < $tempss_size ; ++$tempss_indice)
        {
            $entityManager->remove($tempss[$tempss_indice]);
        }
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

        $entityManager->remove($profondeur);
        $entityManager->flush();

        return $this->render('profondeur/delete.html.twig', [
            'id' => $removedId
        ]);
    }

    /**
    * @Route("profondeur/delete/", name="profondeur_delete_selector")
    */

    // /**
    //  * deleteSelector()
    //  *
    //  * Function for redirect to the twig of delete selector's choice of "Profondeur".
    //  */ 
    public function deleteSelector()
    {
        return $this->render('profondeur/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "profondeur",
        ]);
    }
}
