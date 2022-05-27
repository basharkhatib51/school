<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::findOrFail(1);
        $role->permissions()->createMany([
            ["name" => "User List"],
            ["name" => "Create User"],
            ["name" => "Update User"],
            ["name" => "Delete User"],
            ["name" => "Restore User"],
            ["name" => "Change User Status"],
            ["name" => "Change User Password"],
            ["name" => "Change User Role"],
            ["name" => "Show User Trash"],

            ["name" => "User List Owner"],
            ["name" => "Update User Owner"],
            ["name" => "Delete User Owner"],
            ["name" => "Restore User Owner"],
            ["name" => "Change User Status Owner"],
            ["name" => "Change User Password Owner"],
            ["name" => "Change User Role Owner"],
            ["name" => "Show User Trash Owner"],

            ["name" => "Admin List"],
            ["name" => "Create Admin"],
            ["name" => "Update Admin"],
            ["name" => "Delete Admin"],
            ["name" => "Restore Admin"],
            ["name" => "Change Admin Status"],
            ["name" => "Change Admin Password"],
            ["name" => "Change Admin Role"],
            ["name" => "Show Admin Trash"],

            ["name" => "Admin List Owner"],
            ["name" => "Update Admin Owner"],
            ["name" => "Delete Admin Owner"],
            ["name" => "Restore Admin Owner"],
            ["name" => "Change Admin Status Owner"],
            ["name" => "Change Admin Password Owner"],
            ["name" => "Change Admin Role Owner"],
            ["name" => "Show Admin Trash Owner"],

            ["name" => "Teacher List"],
            ["name" => "Create Teacher"],
            ["name" => "Update Teacher"],
            ["name" => "Delete Teacher"],
            ["name" => "Restore Teacher"],
            ["name" => "Change Teacher Status"],
            ["name" => "Change Teacher Password"],
            ["name" => "Show Teacher Trash"],

            ["name" => "Teacher List Owner"],
            ["name" => "Update Teacher Owner"],
            ["name" => "Delete Teacher Owner"],
            ["name" => "Restore Teacher Owner"],
            ["name" => "Change Teacher Status Owner"],
            ["name" => "Change Teacher Password Owner"],
            ["name" => "Show Teacher Trash Owner"],

            ["name" => "Family List"],
            ["name" => "Create Family"],
            ["name" => "Update Family"],
            ["name" => "Delete Family"],
            ["name" => "Restore Family"],
            ["name" => "Change Family Status"],
            ["name" => "Change Family Password"],
            ["name" => "Show Family Trash"],

            ["name" => "Family List Owner"],
            ["name" => "Update Family Owner"],
            ["name" => "Delete Family Owner"],
            ["name" => "Restore Family Owner"],
            ["name" => "Change Family Status Owner"],
            ["name" => "Change Family Password Owner"],
            ["name" => "Show Family Trash Owner"],

            ["name" => "Student List"],
            ["name" => "Create Student"],
            ["name" => "Update Student"],
            ["name" => "Delete Student"],
            ["name" => "Restore Student"],
            ["name" => "Change Student Status"],
            ["name" => "Change Student Password"],
            ["name" => "Show Student Trash"],

            ["name" => "Student List Owner"],
            ["name" => "Update Student Owner"],
            ["name" => "Delete Student Owner"],
            ["name" => "Restore Student Owner"],
            ["name" => "Change Student Status Owner"],
            ["name" => "Change Student Password Owner"],
            ["name" => "Show Student Trash Owner"],

            ["name" => "Role List"],
            ["name" => "Create Role"],
            ["name" => "Update Role"],
            ["name" => "Delete Role"],
        ]);

        $models = ['Post', 'Page', 'Menu', 'Tag', 'Notification', 'Year', 'Fee', 'ClassLevel'];
        foreach ($models as $model)
            $role->permissions()->createMany([
                ["name" => "$model List"],
                ["name" => "Create $model"],
                ["name" => "Update $model"],
                ["name" => "Delete $model"],
                ["name" => "Restore $model"],
                ["name" => "Show $model Trash"],
                ["name" => "$model List Owner"],
                ["name" => "Update $model Owner"],
                ["name" => "Delete $model Owner"],
                ["name" => "Restore $model Owner"],
                ["name" => "Show $model Trash Owner"],
            ]);
    }
}
