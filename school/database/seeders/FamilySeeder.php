<?php

namespace Database\Seeders;

use App\Models\Family;
use Illuminate\Database\Seeder;
use Hash;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Family::create([
            'first_name' => 'عائلة',
            'last_name' => 'الطالب',
            'user_type' => 'family',
            'email' => 'family@school.com',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);
    }
}
