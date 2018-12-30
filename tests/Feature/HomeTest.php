<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{

    public function getHomeRoute()
    {
        return route('home');
    }

    public function getLoginRoute()
    {
        return route('login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCannotGuestSeeHomePage()
    {
        $response = $this->get($this->getHomeRoute());
        $response->assertRedirect($this->getLoginRoute());
    }

    public function testCanLoggedUserSeeHomePage()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/home');
        $response->assertViewIs('home');

    }

}
