<?php

namespace App\Controller;

use App\Service\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
    
    #[Route('/')]
    public function index(): Response
    {
        $characters = $this->apiService->getApiData();

        return $this->render('table.html.twig', [
            'characters' => $characters
        ]);
    }
    

}