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
//        $response->assertStatus(200);
        $response->assertViewIs('main');
    }

    public function testCanLoggedUserSeeMainPage()
    {

        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->getMainPageRoute());
//        $response->assertStatus(200);

        $response->assertViewIs('main');
    }

}
