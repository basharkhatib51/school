<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::create([
            'first_name' => 'حساب',
            'last_name' => 'المعلم',
            'email' => 'teacher@school.com',
            'user_type' => 'teacher',
            'model_number' => '123456',
            'status' => 'active',
            'password' => Hash::make('password'),
        ]);
    }
}
