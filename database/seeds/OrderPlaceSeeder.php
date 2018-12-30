<?php

use Illuminate\Database\Seeder;
use \App\User;

class OrderPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminModel = new \App\OrderPlace();
        $adminModel->city = "Rzeszow";
        $adminModel->street = "Rejtana";
        $adminModel->zip_code = "35-253";
        $adminModel->houseNumber = "16";
        $adminModel->save();

        $adminModel = new \App\OrderPlace();
        $adminModel->city = "Krakow";
        $adminModel->street = "Witosa";
        $adminModel->zip_code = "35-253";
        $adminModel->houseNumber = "16";
        $adminModel->save();
    }
}
