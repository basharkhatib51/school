<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Family;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Teacher']);
        Role::create(['name' => 'Family']);
        Role::create(['name' => 'Student']);
        $SuperAdmin = User::findOrFail(1);
        $Admin = User::findOrFail(2);
        $Teacher = User::findOrFail(3);
        $Family = User::findOrFail(4);
        $Student = User::findOrFail(5);
        $SuperAdmin->assignRole('SuperAdmin');
        $Admin->assignRole('Admin');
        $Teacher->assignRole('Teacher');
        $Family->assignRole('Family');
        $Student->assignRole('Student');
    }
}
