<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{

    public function getHomeRoute()
    {
        return route('home');
    }

    public function getAdminRoute()
    {
        return route('admin');
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
    public function testCanAdminSeeAdminPage()
    {
        $admin = factory(User::class)->make([
            'isAdmin' => 1
                                           ]);
        $response = $this->actingAs($admin)->get($this->getAdminRoute());
        $response->assertViewIs('admin.index');
    }

    public function testCannotLoggedUserSeeAdminPage()
    {
        $admin = factory(User::class)->make([
                        'isAdmin' => 0
                    ]);
        $response = $this->actingAs($admin)->get($this->getAdminRoute());
        $response->assertRedirect($this->getHomeRoute());

    }

    public function testCannotGuestSeeAdminPage()
    {
        $response = $this->get($this->getAdminRoute());
        $response->assertRedirect($this->getLoginRoute());
    }

}
