<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'checklist-model.index']);
        Permission::create(['name' => 'checklist-model.create']);
        Permission::create(['name' => 'checklist-model.edit']);
        Permission::create(['name' => 'checklist-model.show']);
        Permission::create(['name' => 'checklist-model.destroy']);
        Permission::create(['name' => 'checklist-model.clone']);

        Permission::create(['name' => 'element-model.index']);
        Permission::create(['name' => 'element-model.create']);
        Permission::create(['name' => 'element-model.edit']);
        Permission::create(['name' => 'element-model.destroy']);

        Permission::create(['name' => 'checklist.index']);
        Permission::create(['name' => 'checklist.create']);
        Permission::create(['name' => 'checklist.show']);
        Permission::create(['name' => 'checklist.first-edit']);
        Permission::create(['name' => 'checklist.second-edit']);
        Permission::create(['name' => 'checklist.first-verify-edit']);
        Permission::create(['name' => 'checklist.second-verify-edit']);
        Permission::create(['name' => 'checklist.interchange']);
        Permission::create(['name' => 'checklist.checklist-by-user']);
        Permission::create(['name' => 'checklist.pdf']);
        Permission::create(['name' => 'checklist.expired']);
        Permission::create(['name' => 'checklist.enable']);

        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.show']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.edit-password']);
        Permission::create(['name' => 'user.edit-permission']);
        Permission::create(['name' => 'user.show-deleted-user']);
        Permission::create(['name' => 'user.list-all-users']);

        Permission::create(['name' => 'log.show']);

    }
}
