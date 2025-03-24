<?php

namespace App\Controller;

use App\Service\APiResourceType;
use App\Service\ApiService;
use App\Service\UtilityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EpisodeController extends AbstractController
{
    public function __construct(
        private readonly ApiService $apiService,
        private readonly UtilityService $utilityService)
        {  
        }
 
    #[Route('/episode/{slug}', name: 'episodes')]
    public function indexEpisode(string $slug): Response
    {
        $episodeData = $this->apiService->getApiData(APiResourceType::EPISODE->value, $slug);

        $characters = $episodeData['characters'];

        $characterDataList = $this->apiService->getApiData(APiResourceType::CHARACTER->value, $this->utilityService->extractNumericIds($characters));
        
        return $this->render('episodes.table.html.twig', [
            'episode'    => $episodeData,
            'characters' => $characterDataList
        ]);
    }

}