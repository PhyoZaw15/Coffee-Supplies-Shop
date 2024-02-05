<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'product-show',
            'dashboard',
            'setting-list',
            'master-data-list',

            'user-management-list',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
         ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
