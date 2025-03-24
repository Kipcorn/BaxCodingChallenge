<?php

namespace App\Controller;

use App\Service\ApiResourceType;
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
 
    #[Route('/location/{slug}', name: 'locations')]
    public function indexLocation(string $slug): Response
    {
        $locationData = $this->apiService->getApiData(ApiResourceType::LOCATION->value, $slug);

        if(empty($locationData)) {
            return $this->render('error.html.twig', [
                'message' => 'Location not found'
            ]);
        }

        $characters = $locationData['residents'];

        $characterDataList = $this->apiService->getApiData(APiResourceType::CHARACTER->value, $this->utilityService->extractNumericIds($characters));

        if (!is_array(reset($characterDataList))) {
            $characterDataList = [$characterDataList];
        }

        return $this->render('locations.table.html.twig', [
            'location' => $locationData,
            'characters' => $characterDataList
        ]);
    }

}