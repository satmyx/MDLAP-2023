<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//use Symfony\Component\Security\Core\User\UserInterface;

class CallApiService extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    /**
    * Permet de récupérer un des licenciés via un numéro de licence
    */
    public function getLicenciesPerso($numlicencie) {
        $response = $this->client->request(
            'GET',
            $this->getParameter('API_URL').'licencies?numlicence='.$numlicencie
        );

        return $response->toArray()['hydra:member'];
    }

    /**
    * Permet de récupérer la qualité d'un licencié
    */
    public function getQualite($idqualite) {
        $response = $this->client->request(
            'GET',
            $this->getParameter('API_URL').'qualites/'.$idqualite
        );

        return $response->toArray();
    }

    /**
    * Permet de récupérer la liste des licenciés
    */
    public function getLicencies($numlicencie) {
        $response = $this->client->request(
            'GET',
            $this->getParameter('API_URL').'licencies?numlicence='.$numlicencie
        );

        return $response->toArray()['hydra:member'];
    }
    
    public function getPays($ip) {
        $response = $this->client->request(
            'GET',
            "http://ip-api.com/php/".$ip
        );
        return $response->toArray();
    }

    /**
    * Permet de modifier l'email d'un licencié
    */
    public function patchEmail() {
    /**
     * Ajouter la fonction patch dans l'api
     */
    }
}