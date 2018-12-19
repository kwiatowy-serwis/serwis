<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    private function getAdminPage()
    {
        return route('admin');
    }

    private function getLoginRoute()
    {
        return route('login');
    }

    private function getHomenRoute()
    {
        return route('home');
    }

    public function testCannotGuestSeeAdminPage()
    {
        $response = $this->get($this->getAdminPage());
        $response->assertRedirect($this->getLoginRoute());
    }

    public function testCannotUserSeeAdminPage()
    {
        $user = factory(User::class)->make([
            'password' => bcrypt('testPassword'),
            'email' => 'fake@login.com',
            'isAdmin' => 0,
        ]);
        $response = $this->actingAs($user)->get($this->getAdminPage());
        $response->assertRedirect($this->getHomenRoute());
    }

    public function testCanAdminSeeAdminPage()
    {
        $user = factory(User::class)->make([
            'isAdmin' => 1,
        ]);

        $response = $this->actingAs($user)->get($this->getAdminPage());
        $response->assertViewIs('admin.index');
    }
}
