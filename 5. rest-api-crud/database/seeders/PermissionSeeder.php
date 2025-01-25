<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'Add Role','guard_name' => 'web',],
            ['name' => 'View Role','guard_name' => 'web',],
            ['name' => 'Edit Role','guard_name' => 'web',],
            ['name' => 'Delete Role','guard_name' => 'web',],

            ['name' => 'Add User','guard_name' => 'web',],
            ['name' => 'View User','guard_name' => 'web',],
            ['name' => 'Edit User','guard_name' => 'web',],
            ['name' => 'Delete User','guard_name' => 'web',],

            ['name' => 'Add Driver','guard_name' => 'web',],
            ['name' => 'View Driver','guard_name' => 'web',],
            ['name' => 'Edit Driver','guard_name' => 'web',],
            ['name' => 'Delete Driver','guard_name' => 'web',]
        ]);

        $admin = Role::create(
            ['name' => 'User']);

        $user = Role::create([
            'name' => 'Driver',     
        ]);

        // $user->syncPermissions([
        //     'Add Role',
        // ]);
    }
}