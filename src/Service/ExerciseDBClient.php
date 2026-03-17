<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExerciseDBClient
{
    private HttpClientInterface $client;
    private string $host;
    private string $key;

    public function __construct(HttpClientInterface $client, string $rapidApiHost, string $rapidApiKey)
    {
        $this->client = $client;
        $this->host = $rapidApiHost;
        $this->key = $rapidApiKey;
    }

    /**
     * Récupère la liste de tous les exercices depuis l'API.
     */
    public function getAllExercises(): array
    {
        $response = $this->client->request('GET', 'https://' . $this->host . '/exercises', [
            'headers' => [
                'X-RapidAPI-Host' => $this->host,
                'X-RapidAPI-Key' => $this->key,
            ],
            // 'query' => [
            //    'limit' => 10, // Utile pour les tests initiaux pour ne pas vider le quota
            // ]
        ]);

        return $response->toArray();
    }
}
