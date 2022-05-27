<?php

namespace Database\Seeders;

use App\Models\Generated\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'عربي',
            'semester' => '1',
            'class_level_id' => '1',
            'percentage' => '60',
        ]);
        Subject::create([
            'name' => 'رياضيات',
            'semester' => '1',
            'class_level_id' => '1',
            'percentage' => '40',
        ]);
        Subject::create([
            'name' => 'علوم',
            'semester' => '2',
            'class_level_id' => '1',
            'percentage' => '60',
        ]);
        Subject::create([
            'name' => 'رسم',
            'semester' => '2',
            'class_level_id' => '1',
            'percentage' => '40',
        ]);
    }
}
