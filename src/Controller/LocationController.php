<?php

namespace App\Controller;

use App\Service\ApiDataType;
use App\Service\APiResourceType;
use App\Service\ApiService;
use App\Service\UtilityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LocationController extends AbstractController
{
    public function __construct(
        private readonly ApiService $apiService,
        private readonly UtilityService $utilityService)
        {  
        }
 
    #[Route('/locations/{slug}', name: 'locations')]
    public function indexLocation(string $slug): Response
    {
        $locationData = $this->apiService->getApiData(APiResourceType::LOCATION->value, $slug);

        $residents = $locationData['residents'];

        $residentDataList[] = $this->apiService->getApiData(APiResourceType::CHARACTER->value, $this->utilityService->extractNumericIds($residents));
        
        return $this->render('locations.table.html.twig', [
            'location' => $locationData,
            'residents' => $residentDataList
        ]);
    }

}