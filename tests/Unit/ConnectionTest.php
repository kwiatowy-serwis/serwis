<?php

namespace Tests\Unit;

use App\Services\Kwiaciarnia\Rzeszow;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConnectionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testToTestTrue()
    {
        $this->assertTrue(true);
    }

//    public function testConnectionKwiaciarniaRzeszow()
//    {
//        $kwiaciarniaReszow = new Rzeszow();
//        $kwiaciarniaReszow->pobierzDane();
//
//        $this->assertEquals(200, $kwiaciarniaReszow->getClient()->getStatusCode());
//    }




}
