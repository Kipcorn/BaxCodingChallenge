<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService
{
    public function __construct(
        private readonly HttpClientInterface $client)
    {
    }

    public function getEpisodeData(string $slug): ?array
    {
        $response = $this->client->request(
        'GET', 
        "https://rickandmortyapi.com/api/episode/" . $slug
        );
        
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        return $response->toArray();
    }

    public function getLocationData(string $slug): ?array
    {
        $response = $this->client->request(
            'GET', 
            "https://rickandmortyapi.com/api/location/" . $slug
            );
            
            if ($response->getStatusCode() !== 200) {
                return null;
            }
    
            return $response->toArray();
    }

    public function getCharacterData(string $idString): ?array
    {
        $response = $this->client->request(
        'GET', 
        "https://rickandmortyapi.com/api/character/" . $idString
        );
        
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        return $response->toArray();
    }
    
}