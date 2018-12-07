<?php

use Illuminate\Database\Seeder;
use \App\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminModel = new User();
        $adminModel->name = "admin";
        $adminModel->email = "admin@admin.com";
        $adminModel->password = bcrypt("lol123");
        $adminModel->isAdmin = 1;
        $adminModel->save();
    }
}
