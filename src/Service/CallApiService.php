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
    * Permet de récupérer un des licenciés via un numéro de licence
    */
    public function getLicencies($numlicencie) {
        $response = $this->client->request(
            'GET',
            'http://apimdl/api/licencies?numlicence='.$numlicencie
        );

        return $response->toArray()['hydra:member'];
    }
    
    public function getQualite($idqualite) {
        $response = $this->client->request(
            'GET',
            'http://apimdl/api/qualites/'.$idqualite
        );

        return $response->toArray();
    }

}