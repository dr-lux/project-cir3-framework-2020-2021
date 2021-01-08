<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Temps;
use App\Entity\Profondeur;
use App\Entity\TablePlongee;

use Doctrine\ORM\EntityManagerInterface;

/**
* @Route("/api", name="api")
*/
class ApiController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
    * @Route("/profondeur", name="api_profondeur")
    */
    
    public function ApiProfondeur()
    {
        $profondeurs = $this->getDoctrine()
                            ->getRepository(Profondeur::class)
                            ->findApiAll();
        
        $response = new Response();
        
        $response->setContent(json_encode($profondeurs));
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
    * @Route("/temps", name="api_temps")
    */
    
    public function ApiTemps()
    {
        $tempss = $this->getDoctrine()
                            ->getRepository(Temps::class)
                            ->findApiAll();
        
        $response = new Response();
        
        $response->setContent(json_encode($tempss));
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    // /**
    // * @Route("/temps/id/{id}", name="api_id_temps"
    // */
    
    //  public function ApiIdTemps($id)
    // {
       
    //     $temps = $this->getDoctrine()
    //         ->getRepository(Temps::class)
    //         ->findApiId($id);

    //     if (!$temps) {
    //         $data = [
    //             'status' => 404,
    //             'errors' => "Post not found",
    //            ];
    //         return new JsonResponse($data);
    //     }

    //     $response = new Response();
        
    //     $response->setContent(json_encode($temps));
	// 	$response->headers->set('Content-Type', 'application/json');
	// 	$response->headers->set('Access-Control-Allow-Origin', '*');
    //     return $response;
    // }

    // /**
    // * @Route("/temps/idProfondeur/{idProfondeur}", name="api_estAId_temps")
    // */

    // public function Api_EstAId_Temps($idProfondeur)
    // {
       
    //     $tempss = $this->getDoctrine()
    //         ->getRepository(Temps::class)
    //         ->findApiByProfondeur($idProfondeur);

    //     if (!$tempss) {
    //         $data = [
    //             'status' => 404,
    //             'errors' => "Post not found",
    //            ];
    //         return new JsonResponse($data);
    //     }

    //     $response = new Response();
        
    //     $response->setContent(json_encode($tempss));
	// 	$response->headers->set('Content-Type', 'application/json');
	// 	$response->headers->set('Access-Control-Allow-Origin', '*');
    //     return $response;
    // }

    /**
    * @Route("/temps/depth/{depth}/time/{time}", name="api_Temps_by_Depth_and_Time")
    */

    public function Api_Temps_by_Depth_and_Time($depth, $time)
    {
       
        $tempss = $this->getDoctrine()
            ->getRepository(Temps::class)
            ->findApi_Temps_by_Depth_and_Time($depth, $time);

        if (!$tempss) {
            $data = [
                'status' => 404,
                'errors' => "Post not found",
               ];
            return new JsonResponse($data);
        }

        $response = new Response();
        
        $response->setContent(json_encode($tempss));
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}