<?php

namespace Tests\Feature;

use App\Services\DataManager;
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

    public function getOrderFormRoute()
    {
        return route('orderForm');
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

    public function testCanLoggedUserGoBuyingWithOrderParams()
    {
        $dataManager = new DataManager();
        $flower = $dataManager->getOneRzeszowFlower();
        $serializedFlower = $flower->serialized;

        $admin    = factory(User::class)->make();

        $query = '?'. http_build_query(['flower' => $serializedFlower]);

        $response = $this->actingAs($admin)->get($this->getOrderRoute() . $query);
        $response->assertViewIs('order');
        $response->assertViewHas('flower');
    }

    public function testCannotLoggedUserGoBuyingWithoutParams()
    {
        $user    = factory(User::class)->make();

        $query = '';

        $response = $this->actingAs($user)->get($this->getOrderRoute() . $query);
        $response->assertRedirect('/');
    }

    public function testUserCannotGuestGoFormWithoutParams()
    {
        $response = $this->get($this->getOrderFormRoute());
        $response->assertRedirect($this->getLoginRoute());
    }


    public function testUserCanGoOrderFormWithParams()
    {
        $dataManager = new DataManager();
        $flower = $dataManager->getOneRzeszowFlower();

        $serializedFlower = $flower->serialized;
        $quantity = $flower->quantity - 1;
        $params = [
            'flower' => $serializedFlower,
            'flowerQuantity' => $quantity
        ];

        $admin = factory(User::class)->make();
        $query = '?'. http_build_query($params);

        $response = $this->actingAs($admin)->get($this->getOrderFormRoute(). $query);
        $response->assertViewIs('orderForm');
        $response->assertViewHas('flower');
        $response->assertViewHas('data');
        $response->assertViewHas('couriers');
    }

    public function testUserCannotGoOrderFormWithoutParams()
    {
        $params = [];

        $admin    = factory(User::class)->make();
        $query = '?'. http_build_query($params);

        $response = $this->actingAs($admin)->get($this->getOrderFormRoute() . $query);
        $response->assertRedirect('/');
    }

    public function testUserCannotGoOrderFormWithoutFlowerParam()
    {
        $quantity = 5;
        $params = [
            'flowerQuantity' => $quantity
        ];

        $admin = factory(User::class)->make();
        $query = '?'. http_build_query($params);

        $response = $this->actingAs($admin)->get($this->getOrderFormRoute(). $query);
        $response->assertRedirect('/');
    }

    public function testUserCannotGoOrderFormWithoutFlowerQuantityParam()
    {
        $dataManager = new DataManager();
        $flower = $dataManager->getOneRzeszowFlower();

        $serializedFlower = $flower->serialized;

        $params = [
            'flower' => $serializedFlower,
        ];

        $admin = factory(User::class)->make();
        $query = '?'. http_build_query($params);

        $response = $this->actingAs($admin)->get($this->getOrderFormRoute(). $query);
        $response->assertRedirect('/');
    }

    public function testUserCannotGoOrderFormWithFlowerQuantityLowerThanFlowersNumber()
    {
        $dataManager = new DataManager();
        $flower = $dataManager->getOneRzeszowFlower();

        $serializedFlower = $flower->serialized;
        $quantity = $flower->quantity + 1;

        $params = [
            'flower' => $serializedFlower,
            'flowerQuantity' => $quantity
        ];

        $admin = factory(User::class)->make();
        $query = '?'. http_build_query($params);

        $response = $this->actingAs($admin)->get($this->getOrderFormRoute(). $query);
        $response->assertRedirect('/');
    }
}
