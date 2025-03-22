<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;


class ApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getApiData(): ?array
    {
        $response = $this->client->request(
        'GET', 
        "https://rickandmortyapi.com/api/character"
        );

        $content = $response->toArray();

        $characters = $content['results'];

        return $characters;

    }
}