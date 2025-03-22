<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EpisodeController extends AbstractController
{
    public function __construct(
        private readonly ApiService $apiService)
        {  
        }
 
    #[Route('/episodes/{slug}', name: 'episodes')]
    public function indexEpisode(string $slug): Response
    {
        $episodeData = $this->apiService->getEpisodeData($slug);

        $characterDataList = [];
        $characters = $episodeData['characters'];

        $id = [];

        if (is_array($characters)) {
            foreach ($characters as $character) 
            {
                $parts = explode('/', $character);
                $id = end($parts);
                if (is_numeric($id)) {
                    $ids[] = $id;
                }  
            }
        }

        $idString = implode(',', $ids);
        $characterDataList[] = $this->apiService->getCharacterData($idString);
        
        return $this->render('episodes.table.html.twig', [
            'episode' => $episodeData,
            'characters' => $characterDataList
        ]);
    }

}