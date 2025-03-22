<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

enum APiResourceType: string {
    case CHARACTER = 'character';
    case LOCATION = 'location';
    case EPISODE = 'episode';
}

class ApiService
{
    public function __construct(
        private readonly HttpClientInterface $client)
    {
    }

    public function getApiData(String $resource, string $id): ?array
    {
        $response = $this->client->request(
        'GET', 
        "https://rickandmortyapi.com/api/" . $resource . "/" . $id
        );
        
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        return $response->toArray();
    }
    
}