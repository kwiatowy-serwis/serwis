<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{

    use RefreshDatabase;

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

    public function getUserAdminRoute()
    {
        return route('usersAdmin');
    }

    public function getAllOrdersAdminRoute()
    {
        return route('ordersAdmin');
    }

    public function getUsersAdminRoute()
    {
        return '/admin/user/';
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

    public function testCanAdminSeeAllUsers()
    {
        $admin = factory(User::class)->make([
            'isAdmin' => 1
        ]);

        $response = $this->actingAs($admin)->get($this->getUserAdminRoute());
        $response->assertViewIs('admin.usersAdmin');
        $data = $response->getOriginalContent()->getData();
        $this->assertArrayHasKey('users', $data);
        $response->assertStatus(200);
    }

    public function testCannotUserSeeAllUsers()
    {
        $user = factory(User::class)->make([
            'isAdmin' => 0
        ]);

        $response = $this->actingAs($user)->get($this->getUserAdminRoute());
        $response->assertRedirect($this->getHomeRoute());
    }

    public function testCanAdminSeeOrders()
    {
        $admin = factory(User::class)->create([
            'isAdmin' => 1
        ]);

        $response = $this->actingAs($admin)->get($this->getAllOrdersAdminRoute());
        $response->assertViewIs('admin.ordersAdmin');
        $data = $response->getOriginalContent()->getData();
        $this->assertArrayHasKey('flowerOrders', $data);
    }


    public function testCanAdminSeeConcreteUser()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->create([
            'isAdmin' => 1
        ]);
        $userId = $user->id;

        $url = $this->getUsersAdminRoute() . $userId;
        $response = $this->actingAs($admin)->get($url);
        $response->assertViewIs('admin.concreteUserAdmin');
    }

    public function testCanAdminSeeConcreteUserWhenNotExist()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->create([
            'isAdmin' => 1
        ]);

        $url = $this->getUsersAdminRoute() . ($user->id + 1);
        $response = $this->actingAs($admin)->get($url);
        $response->assertStatus(404);
    }

}
