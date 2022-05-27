<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name' => 'المسؤول',
            'last_name' => 'الرئيسي',
            'email' => 'admin@admin.com',
            'status' => 'active',
            'user_type' => 'admin',
            'password' => Hash::make('password'),
        ]);Admin::create([
            'first_name' => 'المسؤول',
            'last_name' => 'العادي',
            'email' => 'admin@school.com',
            'status' => 'active',
            'user_type' => 'admin',
            'password' => Hash::make('password'),
        ]);
    }
}
