<?php

namespace app\libs\authenticate;

use Google\Client;
use Google\Service\Oauth2 as ServiceOauth2;
use GuzzleHttp\Client as GuzzleClient;
use Google\Service\Oauth2\Userinfo;

class GoogleClient
{
    public readonly Client $client;
    private Userinfo $data;

    public function __construct()
    {
        $this->client = new Client;
    }

    public function init()
    {
        $guzzleClient = new GuzzleClient(['curl' => [CURLOPT_SSL_VERIFYPEER => false]]);
        $this->client->setAuthConfig('../credentials.json');
        $this->client->setRedirectUri('http://localhost/xistopet/private/verificarLoginGoogle.php');
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function authorized()
    {
        if (isset($_GET['code'])) {
            $token = $this->client->fetchAccessTokenWithAuthCode($_GET['code']);
            $this->client->setAccessToken($token['access_token']);
            $googleService = new ServiceOauth2($this->client);
            $this->data = $googleService->userinfo->get();

            return true;
        }

        return false;
    }

    public function getData()
    {
        return $this->data;
    }

    public function generateAuthLink()
    {
        return $this->client->createAuthUrl();
    }
}