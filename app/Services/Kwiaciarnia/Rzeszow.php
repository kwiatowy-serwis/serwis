<?php

namespace App\Services\Kwiaciarnia;

use App\Services\Connections\HttpMethods;
use App\Services\Kwiaciarnia\Abstracts\KwiaciarniaBase;
use App\Services\Kwiaciarnia\Interfaces\Kwiaciarnia;

/**
 * Artur Pilch <artur.pilch12@gmail.com>
 */
class Rzeszow extends KwiaciarniaBase implements Kwiaciarnia
{
//    private $url = 'http://kwiaciarnia-rzeszow.test/';
    private $url = 'http://192.168.56.103/kwiaciarnia-rzeszow/public/';

    public function pobierzDane ()
    {
        $endpoint = 'flower';
        $result = $this->client->request(HttpMethods::GET, $this->url . $endpoint);
        return $this->responseToArray($result);
    }
}