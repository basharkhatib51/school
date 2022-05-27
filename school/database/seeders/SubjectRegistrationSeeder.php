<?php

namespace Database\Seeders;

use App\Models\Generated\Subject;
use App\Models\Generated\SubjectRegistration;
use Illuminate\Database\Seeder;

class SubjectRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubjectRegistration::create([
            'chat_status' => 1,
            'subject_id' => '1',
            'teacher_id' => '3',
            'classroom_id' => '1',
            'percentage' => '60',
        ]);
    }
}
