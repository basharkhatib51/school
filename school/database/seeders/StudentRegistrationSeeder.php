<?php

namespace Database\Seeders;

use App\Models\Generated\StudentRegistration;
use Illuminate\Database\Seeder;

class StudentRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentRegistration::create([
            'student_id' => '5',
            'classroom_id' => '1',
        ]);
    }
}
