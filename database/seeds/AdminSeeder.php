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
        $adminModel->password = bcrypt("admin");
        $adminModel->isAdmin = 1;
        $adminModel->save();

        $adminModel = new User();
        $adminModel->name = "user";
        $adminModel->email = "user@user.com";
        $adminModel->password = bcrypt("user");
        $adminModel->isAdmin = 0;
        $adminModel->save();
    }
}
