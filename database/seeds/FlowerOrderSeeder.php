<?php

use Illuminate\Database\Seeder;
use \App\User;

class FlowerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminModel = new \App\FlowerOrder();
        $adminModel->florist_company = "Rzeszow";
        $adminModel->courier_company = "GlobalUser";
        $adminModel->order_place_id = 1;
        $adminModel->user_id = 1;
        $adminModel->ware = "ware1";
        $adminModel->quantity = rand(0,10);
        $adminModel->price = rand(1,100);
        $adminModel->save();

        $adminModel = new \App\FlowerOrder();
        $adminModel->florist_company = "Krakow";
        $adminModel->courier_company = "GlobalUser";
        $adminModel->order_place_id = 2;
        $adminModel->user_id = 1;
        $adminModel->ware = "ware2";
        $adminModel->quantity = rand(0,10);
        $adminModel->price = rand(1,100);
        $adminModel->save();
    }
}
