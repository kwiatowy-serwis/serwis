<?php

namespace Tests\Feature;

use App\FlowerOrder;
use App\OrderPlace;
use App\Services\DataManager;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{

    use RefreshDatabase;

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

    public function getHomeRoute()
    {
        return route('home');
    }

    public function getMakeOrderRoute()
    {
        return '/order/make';
        return route('makeOrder');
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

    public function testUserCanMakeOrder()
    {
        $dataManager = new DataManager();
        $flower = $dataManager->getOneRzeszowFlower();


        $firstname = 'Jan';
        $lastname = 'Kowalski';
        $phone = '123123123';
        $city= 'rzeszow';
        $street = 'Rejtana';
        $zip_code = '35-345';
        $houseNumber = '14';

        $quantity = $flower->quantity - 1;
        $flowerPrice = $flower->price * $quantity;
        $data = [
            'flowerId' => $flower->id,
            'flowerQuantity' => $quantity,
            'flowerName' => $flower->name,
            'PriceForFlower' => $flowerPrice,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'city'=> $city,
            'street' => $street,
            'zip_code' => $zip_code,
            'houseNumber' => $houseNumber,
            'test' => 'true'
        ];

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post($this->getMakeOrderRoute(), $data);

        $response->assertRedirect($this->getHomeRoute());

        $this->assertCount(1, $orders = FlowerOrder::all());
        $order = $orders->first();
        $this->assertEquals($flower->name, $order->ware);
        $this->assertEquals($quantity, $order->quantity);
        $this->assertEquals($flowerPrice, $order->price);

        $this->assertCount(1, $ordersPlaces = OrderPlace::all());
        $orderPlace = $ordersPlaces->first();
        $this->assertEquals($firstname, $orderPlace->firstname);
        $this->assertEquals($lastname, $orderPlace->lastname);
        $this->assertEquals($city, $orderPlace->city);
        $this->assertEquals($street, $orderPlace->street);
        $this->assertEquals($zip_code, $orderPlace->zip_code);
        $this->assertEquals($phone, $orderPlace->phone);
        $this->assertEquals($houseNumber, $orderPlace->houseNumber);
    }






}
