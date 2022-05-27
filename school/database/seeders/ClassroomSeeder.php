<?php

namespace Database\Seeders;

use App\Models\Generated\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::create([
            'name' => 'الشعبة الأولى',
            'class_level_id' => '1',
            'year_id' => '1',
        ]);
        Classroom::create([
            'name' => 'الشعبة الثاتية',
            'class_level_id' => '1',
            'class_level_id' => '1',
            'year_id' => '1',
        ]);
    }
}
