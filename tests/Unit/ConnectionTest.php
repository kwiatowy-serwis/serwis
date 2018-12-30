<?php

namespace Tests\Unit;


use App\Services\Kurier\GlobalKurier;
use App\Services\Kwiaciarnia\Krakow;
use App\Services\Kwiaciarnia\Rzeszow;
use Tests\TestCase;

class ConnectionTest extends TestCase
{

    public function testConnectionKwiaciarniaRzeszow()
    {
        $kwiaciarniaReszow = new Rzeszow();
        $response =  $kwiaciarniaReszow->pobierzDane();

        $this->assertIsArray($response);
        $this->assertEquals(200, $kwiaciarniaReszow->getClient()->getStatusCode());
    }

    public function testConnectionKwiaciarniaKrakow()
    {
        $kwiaciarniaKrakow = new Krakow();
        $response = $kwiaciarniaKrakow->pobierzDane();

        $this->assertIsArray($response);
        $this->assertEquals(200, $kwiaciarniaKrakow->getClient()->getStatusCode());
    }

    public function testConnectionKurier()
    {
        $kurier = new GlobalKurier();
        $response = $kurier->pobierzKurierow();

        $this->assertIsArray($response);
        $this->assertEquals(200, $kurier->getClient()->getStatusCode());
    }





}
