<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    public function getOrderRoute()
    {
        return route('order');
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
    public function testCannotGuestGoBuying()
    {
        $response = $this->get($this->getOrderRoute());
        $response->assertRedirect($this->getLoginRoute());
    }

    public function canLoggedUserGoBuying()
    {
        $admin    = factory(User::class)->make();
        $response = $this->actingAs($admin)->get($this->getOrderRoute());
        $response->assertViewIs('order');
        $response->assertViewHas('flower');
    }
}
