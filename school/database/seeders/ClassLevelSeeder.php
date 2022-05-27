<?php

namespace Database\Seeders;

use App\Models\Generated\ClassLevel;
use Illuminate\Database\Seeder;

class ClassLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassLevel::create([
            'name' => 'الصف الأول',
        ]);
        ClassLevel::create([
            'name' => 'الصف الثاتي',
        ]);
        ClassLevel::create([
            'name' => 'الصف الثالث',
        ]);
        ClassLevel::create([
            'name' => 'الصف الرابع',
        ]);
        ClassLevel::create([
            'name' => 'الصف الخامس',
        ]);
        ClassLevel::create([
            'name' => 'الصف السادس',
        ]);
    }
}
