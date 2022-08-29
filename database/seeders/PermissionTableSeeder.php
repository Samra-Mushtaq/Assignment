<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $permissions = [
        //    'role-list',
        //    'role-create',
        //    'role-edit',
        //    'role-delete',
        //    'product-list',
        //    'product-create',
        //    'product-edit',
        //    'product-delete'
        // //    ,'category-list',
        // //    'category-create',
        // //    'category-edit',
        // //    'category-delete'
        // ];
        
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        $permissions = [
            // roles
                ['group' => 'roles', 'name' => 'role-list', 'title' => 'View Roles', 'guard_name' => 'web'],
                ['group' => 'roles', 'name' => 'role-create', 'title' => 'Add Roles', 'guard_name' => 'web'],
                ['group' => 'roles', 'name' => 'role-edit', 'title' => 'Edit Roles', 'guard_name' => 'web'],
                ['group' => 'roles', 'name' => 'role-delete', 'title' => 'Delete Roles', 'guard_name' => 'web'],
            // Products
                ['group' => 'products', 'name' => 'product-list', 'title' => 'View Products', 'guard_name' => 'web'],
                ['group' => 'products', 'name' => 'product-create', 'title' => 'Add Products', 'guard_name' => 'web'],
                ['group' => 'products', 'name' => 'product-edit', 'title' => 'Edit Products', 'guard_name' => 'web'],
                ['group' => 'products', 'name' => 'product-delete', 'title' => 'Delete Products', 'guard_name' => 'web'],

            // categories
                ['group' => 'categories', 'name' => 'category-list', 'title' => 'View categories', 'guard_name' => 'web'],
                ['group' => 'categories', 'name' => 'category-create', 'title' => 'Add categories', 'guard_name' => 'web'],
                ['group' => 'categories', 'name' => 'category-edit', 'title' => 'Edit categories', 'guard_name' => 'web'],
                ['group' => 'categories', 'name' => 'category-delete', 'title' => 'Delete categories', 'guard_name' => 'web'],

            
            // notifications
                ['group' => 'notifications', 'name' => 'notification-list', 'title' => 'View Notifications', 'guard_name' => 'web'],
                ['group' => 'notifications', 'name' => 'notification-create', 'title' => 'Add Notifications', 'guard_name' => 'web'],
                ['group' => 'notifications', 'name' => 'notification-edit', 'title' => 'Edit Notifications', 'guard_name' => 'web'],
                ['group' => 'notifications', 'name' => 'notification-delete', 'title' => 'Delete Notifications', 'guard_name' => 'web'],

            // translations
                ['group' => 'translations', 'name' => 'translation-list', 'title' => 'View Translations', 'guard_name' => 'web'],
                ['group' => 'translations', 'name' => 'translation-create', 'title' => 'Add Translations', 'guard_name' => 'web'],
                ['group' => 'translations', 'name' => 'translation-edit', 'title' => 'Edit Translations', 'guard_name' => 'web'],
                ['group' => 'translations', 'name' => 'translation-delete', 'title' => 'Delete Translations', 'guard_name' => 'web'],
        ];
        Permission::insert($permissions);
    }
}
