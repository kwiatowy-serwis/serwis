<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MainPageTest extends TestCase
{

    public function getMainPageRoute()
    {
        return '/';
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanSeeMainPage()
    {
        $response = $this->get($this->getMainPageRoute());
        $response->assertViewIs('main');
    }

    public function testCanLoggedUserSeeMainPage()
    {

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->getMainPageRoute());
        $response->assertViewIs('main');
    }


    public function testCanSeeKrakowFlowers()
    {
        $city = 'Kraków';
        $request = $this->getMainPageRoute() . '?'. http_build_query(['cityName' => $city]);

        $response = $this->get($request);
        $response->assertViewIs('main-krakow');

        $data = $response->getOriginalContent()->getData();
        $this->assertArrayHasKey('flowers_kr', $data);
    }

    public function testLoggedUserCanSeeKrakowFlowers()
    {
        $user = factory(User::class)->make();
        $city = 'Kraków';
        $request = $this->actingAs($user)->getMainPageRoute() . '?'. http_build_query(['cityName' => $city]);

        $response = $this->get($request);
        $response->assertViewIs('main-krakow');

        $data = $response->getOriginalContent()->getData();
        $this->assertArrayHasKey('flowers_kr', $data);
    }
}
