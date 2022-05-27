<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            TeacherSeeder::class,
            FamilySeeder::class,
            StudentSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            GenerateSeeder::class,
            PersonalAccessTokenSeeder::class,
            YearSeeder::class,
            MenuSeeder::class,
            ImageSeeder::class,
            ClassLevelSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
            FeeSeeder::class,
            SubjectRegistrationSeeder::class,
            StudentRegistrationSeeder::class,
            ExamSeeder::class,
            ResultSeeder::class,
           ProgramSeeder::class,
        ]);
    }
}
