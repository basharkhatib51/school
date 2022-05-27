<?php

namespace Database\Seeders;

use App\Models\Generated\Fee;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fee::create([
            'value' => 2000,
            'class_level_id' => '1',
            'year_id' => '1',
        ]);
    }
}
