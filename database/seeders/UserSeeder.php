<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone_no' => '00000000000'
        ]);

        $admin->assignRole('admin');
        // $role = Role::create(['name' => 'Admin']);
       
        // $permissions = Permission::pluck('id','id')->all();
     
        // $role->syncPermissions($permissions);
       
        // $user->assignRole([$role->id]);
    }
}
