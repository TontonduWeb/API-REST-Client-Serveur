<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class NutApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetch(): array
    {
        $response = $this->client->request(
            'GET',
            'http://faed3946e7cd.ngrok.io/nuts'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }

    public function send($product)
    {
        $response = $this->client->request(
            'POST',
            'http://faed3946e7cd.ngrok.io/nut/buy/' . $product
        );
        $content = $response->getContent();
        $content = $response->toArray();

        return $content;
    }
}