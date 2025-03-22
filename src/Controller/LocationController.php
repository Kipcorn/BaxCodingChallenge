<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocationController extends AbstractController
{
    public function __construct(
        private readonly ApiService $apiService)
        {  
        }
 
    #[Route('/locations/{slug}', name: 'locations')]
    public function indexLocation(string $slug): Response
    {
        $locationData = $this->apiService->getLocationData($slug);

        $residents = $locationData['residents'];

        $id = [];

        if (is_array($residents)) {
            foreach ($residents as $resident) 
            {
                $parts = explode('/', $resident);
                $id = end($parts);
                if (is_numeric($id)) {
                    $ids[] = $id;
                }  
            }
        }

        $idString = implode(',', $ids);

        $residentDataList[] = $this->apiService->getCharacterData($idString);
        
        return $this->render('locations.table.html.twig', [
            'location' => $locationData,
            'residents' => $residentDataList
        ]);
    }

}