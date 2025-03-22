<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EpisodeController extends AbstractController
{
    private $apiService;
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
    
    #[Route('/episodes/{slug}', name: 'episodes')]
    public function indexEpisode(string $slug): Response
    {
        $episodeData = $this->apiService->getEpisodeData($slug);

        $characterDataList = [];
        $characters = $episodeData['characters'];

        if (is_array($characters)) {
            foreach ($characters as $character) 
            {
                $characterDataList[] = $this->apiService->getCharacterData($character);
            }
        }
        
        return $this->render('episodes.table.html.twig', [
            'episode' => $episodeData,
            'characters' => $characterDataList
        ]);
    }

}