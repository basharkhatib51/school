<?php

namespace Database\Seeders;

use App\Models\Generated\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exam::create([
            'type' => 'المذاكرة الاولى',
            'subject_registration_id' => '1',
            'percentage' => '20',
        ]);
        Exam::create([
            'type' => 'المذاكرة الثانية',
            'subject_registration_id' => '1',
            'percentage' => '20',
        ]);
        Exam::create([
            'type' => 'الفخص',
            'subject_registration_id' => '1',
            'percentage' => '60',
        ]);
    }
}
