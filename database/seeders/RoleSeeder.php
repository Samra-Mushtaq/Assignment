<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $admin = Role::updateOrCreate(['name' => 'admin']);
        

        //Permissions
        $permissions = Permission::all();
        
        //Assign permissions to roles

        $admin->syncPermissions(['role-list', 'role-create', 'role-edit', 'role-delete', 'product-list', 'product-create', 'product-edit', 'product-delete', 'category-list', 'category-create', 'category-edit', 'category-delete', 'notification-list', 'notification-create', 'notification-edit', 'notification-delete', 'translation-list', 'translation-create', 'translation-edit', 'translation-delete']);


     
    }
}
