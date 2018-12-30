<?php

namespace App\Services\Kurier;

use App\Services\Connections\HttpMethods;
use App\Services\Kwiaciarnia\Abstracts\ConnectionBase;
use App\Services\Kurier\Interfaces\Kurier;

/**
 * Artur Pilch <artur.pilch12@gmail.com>
 */
class GlobalKurier extends ConnectionBase implements Kurier
{
    private $url = 'http://192.168.56.103/kurier/public/api/kurier';


    public function pobierzKurierow ()
    {
        $result = $this->client->request(HttpMethods::GET, $this->url);
        return $this->responseToArray($result);
    }


    public function makeOrder ($id)
    {
        $params = [
            'form_params' => [
                'id' => $id
            ]
        ];
        $endpoint = '/order';

        $result = $this->client->request(HttpMethods::POST, $this->url . $endpoint, $params);
        return $this->responseToArray($result);
    }
}