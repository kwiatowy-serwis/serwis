<?php

namespace App\Services\Kwiaciarnia\Abstracts;

use App\Services\Connections\HttpClient;

/**
 * Artur Pilch <artur.pilch12@gmail.com>
 */
abstract class KwiaciarniaBase
{
    /**
     * @var HttpClient
     */
    protected $client;

    public function __construct ()
    {
        $this->client = new HttpClient();
    }

    public function responseToArray($response)
    {
        $response = json_decode($response);
        return $response->data;
    }

    public function getClient()
    {
        return $this->client;
    }
}