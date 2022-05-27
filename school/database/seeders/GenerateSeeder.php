<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GenerateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $models = ['SubjectRegistration','StudentRegistration','Subject','ClassLevel','Classroom','Fee','Payment','Exam','Notification','Message','Program','Year'];
//        $role = Role::findOrFail(1);
//        foreach ($models as $model)
//            $role->permissions()->createMany([
//                ["name" => "$model List"],
//                ["name" => "Create $model"],
//                ["name" => "Update $model"],
//                ["name" => "Delete $model"],
//                ["name" => "Restore $model"],
//                ["name" => "Show $model Trash"],
//                ["name" => "$model List Owner"],
//                ["name" => "Update $model Owner"],
//                ["name" => "Delete $model Owner"],
//                ["name" => "Restore $model Owner"],
//                ["name" => "Show $model Trash Owner"],
//            ]);
    }
}
