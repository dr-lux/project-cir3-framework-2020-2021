<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * DefaultParamController.php
 * 
 * Controller of the 'DefaultParam' entity with CRUD's functions.
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\DefaultParam;
use App\Form\DefaultParamType;
use Symfony\Component\HttpFoundation\Request;


class DefaultParamController extends AbstractController
{
    /**
     * @Route("defaultParam/read/all", name="defaultParam_readAll")
     * 
     * readAll()
     * 
     * Function for display all entries from "DefaultParam" by a twig.
     */

    public function readAll()
    {
        $defaultParams = $this->getDoctrine()
                        ->getRepository(DefaultParam::class)
                        ->findAll();
        
        return $this->render('default_param/readAll.html.twig', [
            'defaultParams' => $defaultParams,
        ]);
    }

    /**
     * @Route("defaultParam/read/{id}", name="defaultParam_read")
     * 
     * read($id)
     *
     * Function for display the entry where the id is specified and exist from "DefaultParam" by a twig.
     */

    public function read($id)
    {
        $defaultParam = $this->getDoctrine()
                        ->getRepository(DefaultParam::class)
                        ->find($id);
        
        if (!$defaultParam)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }

        return $this->render('default_param/read.html.twig', [
            'defaultParam' => $defaultParam,
        ]);
    }

    /**
     * @Route("defaultParam/read/", name="defaultParam_read_selector")
     * 
     * readSelector()
     *
     * Function for redirect to the twig of read selector's choice of "DefaultParam".
     */

    public function readSelector()
    {
        return $this->render('default_param/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "defaultParam",
        ]);
    }

    /**
     * @Route("defaultParam/edit/check/{id}", name="defaultParam_edit_check", methods={"GET", "POST"})
     * 
     * checkEditAvailable($id)
     * 
     * Function for make a redirection to the edition page if the specified entry from "DefaultParam" exist.
     */

    public function checkEditAvailable($id)
    {
        $defaultParam = $this->getDoctrine()
                ->getRepository(DefaultParam::class)
                ->find($id);

        if (!$defaultParam)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }

        header('Location: http://localhost:8000/defaultParam/edit/'.$id);
        exit();
    }

    /**
     * @Route("defaultParam/edit/{id}", name="defaultParam_edit", methods={"GET", "POST"})
     * 
     * edit(Request $request, DefaultParam $defaultParam)
     * 
     * Function for make an edition of an entry from "DefaultParam" by a twig.
     */

    public function edit(Request $request, DefaultParam $defaultParam)
    {
        $form = $this->createForm(DefaultParamType::class, $defaultParam);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('defaultParam_readAll');
        }

        return $this->render('default_param/edit.html.twig', [
            'defaultParam' => $defaultParam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("defaultParam/edit/", name="defaultParam_edit_selector")
     *
     * editSelector()
     *
     * Function for redirect to the twig of edit selector's choice of "DefaultParam".
     */

    public function editSelector()
    {
        return $this->render('default_param/selector.html.twig', [
            'crud_method' => "edit",
            'entity' => "defaultParam",
        ]);
    }

    /**
     * @Route("defaultParam/new", name="defaultParam_new", methods={"GET","POST"})
     * 
     * new(Request $request)
     *
     * Function for create a new "DefaultParam" entry.
     */

    public function new(Request $request): Response
    {
        $defaultParam = new DefaultParam();
        $form = $this->createForm(DefaultParamType::class, $defaultParam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($defaultParam);
            $entityManager->flush();
            return $this->redirectToRoute('defaultParam_readAll');
        }

        return $this->render('default_param/new.html.twig', [
            'defaultParam' => $defaultParam,
            'form' => $form->createView(),
            ]);       
    }

    /**
     * @Route("defaultParam/delete/{id}", name="defaultParam_delete")
     * 
     * delete($id)
     *
     * Function for delete a specified "DefaultParam" entry.
     */
    
    public function delete($id)
    {
        $defaultParam = $this->getDoctrine()
                        ->getRepository(DefaultParam::class)
                        ->find($id);
        if (!$defaultParam)
        {
            return $this->render('error.html.twig', [
                'message' => "No data found for ID ".$id
            ]);
        }
        $removedId = $defaultParam->getId();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($defaultParam);
        $entityManager->flush();

        return $this->render('default_param/delete.html.twig', [
            'id' => $removedId
        ]);
    }
    
    /**
     * @Route("defaultParam/delete/", name="defaultParam_delete_selector")
     * 
     * deleteSelector()
     *
     * Function for redirect to the twig of delete selector's choice of "DefaultParam".
     */

    public function deleteSelector()
    {
        return $this->render('defaultParam/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "defaultParam",
        ]);
    }
}
