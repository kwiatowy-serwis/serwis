<?php

namespace App\Services\Connections;

use GuzzleHttp\Client;

/**
 * Artur Pilch <artur.pilch12@gmail.com>
 */
class HttpClient
{
    /**
     * @var Client
     */
    private $client;

    private $header;

    private $statusCode;

    private $body;

    public function __construct ()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function request ($method = HttpMethods::GET, $url, $options = [])
    {
        $response = $this->client->request($method, $url, $options);

        $this->header = $response->getHeader('content-type');
        $this->statusCode = $response->getStatusCode();
        $this->body = $response->getBody();

        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getHeader ()
    {
        return $this->header;
    }

    /**
     * @return mixed
     */
    public function getStatusCode ()
    {
        return $this->statusCode;
    }

    /**
     * @return mixed
     */
    public function getBody ()
    {
        return $this->body;
    }


}