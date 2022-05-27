<?php

namespace Database\Seeders;

use App\Models\Generated\Result;
use Illuminate\Database\Seeder;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Result::create([
            'value' => '50',
            'student_id' => '5',
            'exam_id' => '1',
        ]);
        Result::create([
            'value' => '60',
            'student_id' => '5',
            'exam_id' => '2',
        ]);
        Result::create([
            'value' => '40',
            'student_id' => '5',
            'exam_id' => '3',
        ]);
    }
}
