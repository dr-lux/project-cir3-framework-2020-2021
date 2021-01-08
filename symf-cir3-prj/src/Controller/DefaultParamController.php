<?php

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
    */

    public function readSelector()
    {
        return $this->render('default_param/selector.html.twig', [
            'crud_method' => "read",
            'entity' => "defaultParam",
        ]);
    }

    /**
     * @Route("defaultParam/edit/{id}", name="defaultParam_edit", methods={"GET", "POST"})
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
    */

    public function deleteSelector()
    {
        return $this->render('default_param/selector.html.twig', [
            'crud_method' => "delete",
            'entity' => "defaultParam",
        ]);
    }
}
