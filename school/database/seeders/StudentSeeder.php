<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Hash;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'first_name' => 'حساب',
            'last_name' => 'الطالب',
            'email' => 'student@school.com',
            'model_number' => '123456789',
            'user_type' => 'student',
            'status' => 'active',
            'family_id' => 4,
            'password' => Hash::make('password'),
        ]);
    }
}
