<?php

namespace App\Services\Kwiaciarnia;

use App\Services\Connections\HttpMethods;
use App\Services\Kwiaciarnia\Abstracts\ConnectionBase;
use App\Services\Kwiaciarnia\Interfaces\Kwiaciarnia;

/**
 * Artur Pilch <artur.pilch12@gmail.com>
 */
class Rzeszow extends ConnectionBase implements Kwiaciarnia
{
//    private $url = 'http://kwiaciarnia-rzeszow.test/';
      private $url = 'http://192.168.56.103/kwiaciarniaRzeszow/public/api/flower';

    //private $url = 'http://kwiaciarnia-rzeszow.test/api/flower';

    public function pobierzDane ()
    {
        $result = $this->client->request(HttpMethods::GET, $this->url);
        return $this->responseToArray($result);
    }


    public function makeOrder ($id, $quantity)
    {
        $params = [
            'form_params' => [
                'id' => $id,
                'quantity' => $quantity
            ]
        ];
        $endpoint = '/order';

        $result = $this->client->request(HttpMethods::POST, $this->url . $endpoint, $params);
        return $this->responseToArray($result);
    }
}