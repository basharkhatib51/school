<?php

namespace Database\Seeders;

use App\Models\Generated\Program;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::create([
            'start_at' => Carbon::createFromFormat('h:i','03:15')->format('h:i:s'),
            'finish_at' => Carbon::createFromFormat('h:i','04:15')->format('h:i:s'),
            'day' => 'Monday',
            'subject_registration_id' => '1',
        ]);
        Program::create([
            'start_at' => Carbon::createFromFormat('h:i','03:15')->format('h:i:s'),
            'finish_at' => Carbon::createFromFormat('h:i','04:15')->format('h:i:s'),
            'day' => 'Monday',
            'subject_registration_id' => '1',
        ]);
    }
}
