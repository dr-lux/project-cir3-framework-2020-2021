<?php
/**
 * @author: Titouan Allain
 * @version: 1.0
 * 
 * ApiController.php
 * 
 * Controller Api for request JSON data from entities.
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Temps;
use App\Entity\Profondeur;
use App\Entity\TablePlongee;
use App\Entity\DefaultParam;

use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/profondeur", name="api_profondeur")
     * 
     * ApiProfondeur()
     * 
     * Function for request all entries of "Profondeur" entity and send them as JSON data.
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
     * @Route("/profondeur/depth/{depth}", name="api_profondeur_by_depth")
     * 
     * ApiProfondeurByDepth()
     * 
     * Function for request the first entry of "Profondeur" entity with a specified depth and send them as JSON data.
     */

    public function ApiProfondeurByDepth($depth)
    {
        $profondeurs = $this->getDoctrine()
                            ->getRepository(Profondeur::class)
                            ->findFirstByDepth($depth);
        
        $response = new Response();
        
        $response->setContent(json_encode($profondeurs));
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/temps", name="api_temps")
     * 
     * ApiTemps()
     * 
     * Function for request all entries of "Temps" entity and send them as JSON data.
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

    /**
     * @Route("/defaultParam", name="api_defaultParam")
     * 
     * ApiDefaultParam()
     * 
     * Function for request all entries of "DefaultParam" entity and send them as JSON data.
     */
    
    public function ApiDefaultParam()
    {
        $defaultParam = $this->getDoctrine()
                            ->getRepository(DefaultParam::class)
                            ->findApi();
        
        $response = new Response();
        
        $response->setContent(json_encode($defaultParam));
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    /**
     * @Route("/temps/depth/{depth}/time/{time}", name="api_Temps_by_Depth_and_Time")
     * 
     * Api_Temps_by_Depth_and_Time($depth, $time)
     * 
     * Function for request the first entry of "Temps" entity where depth and time values are 
     * repectivly the minimum values of depth and time of this entry.
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

        // $profondeur = $this->getDoctrine()
        //         ->getRepository(Profondeur::class)
        //         ->findFirstByDepth($depth);

        $response = new Response();


        
        $response->setContent(json_encode($tempss));
        // $response->addContent(json_encode($profondeur));
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}