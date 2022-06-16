<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dev_permission = Permission::query()->where('slug', '=', 'create-tasks')->first();
        $manager_permission = Permission::query()->where('slug', '=', 'edit-users')->first();


        $dev_role = new Role();
        $dev_role->slug = 'developer';
        $dev_role->name = 'Front-end Developer';
        $dev_role->save();
        $dev_role->permissions()->attach($dev_permission);

        $manager_role = new Role();
        $manager_role->slug = 'manager';
        $manager_role->name = 'Assistant Manager';
        $manager_role->save();
        $manager_role->permissions()->attach($manager_permission);

        $dev_role = Role::query()->where('slug', '=', 'developer')->first();
        $manager_role = Role::query()->where('slug', '=', 'manager')->first();

        $createTasks = new Permission();
        $createTasks->slug = 'create-tasks';
        $createTasks->name = 'Create Tasks';
        $createTasks->save();
        $createTasks->roles()->attach($dev_role);

        $editUsers = new Permission();
        $editUsers->slug = 'edit-users';
        $editUsers->name = 'Edit Users';
        $editUsers->save();
        $editUsers->roles()->attach($manager_role);

        $dev_role = Role::query()->where('slug', '=', 'developer')->first();
        $manager_role = Role::query()->where('slug', '=', 'manager')->first();
        $dev_perm = Permission::query()->where('slug', '=', 'create-tasks')->first();
        $manager_perm = Permission::query()->where('slug', '=', 'edit-users')->first();

        $developer = new User();
        $developer->name = 'Developer Example';
        $developer->email = 'developer@example.com';
        $developer->password = bcrypt('123456');
        $developer->save();
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_perm);

        $manager = new User();
        $manager->name = 'Manger Example';
        $manager->email = 'manager@example.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_perm);
    }
}
