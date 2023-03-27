<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
//use Symfony\Component\Security\Core\User\UserInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
    * Permet de récupérer la liste des licenciés
    */
    public function getLicencies() {
        $response = $this->client->request(
            'GET',
            'http://apimdl/api/licencies'
        );

        return $response->toArray();
    }

}