<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        // $role1 = Role::create(['name' => 'Admin']);
        /* $role2 = Role::create(['name' => 'Empleado']);
        $role3 = Role::create(['name' => 'Jefe']);
        $role4 = Role::create(['name' => 'Supervisor']);
        $role5 = Role::create(['name' => 'Gerente']); */

        /* Permission::create(['name' => 'admin.admin'])->assignRole($role1);
        Permission::create(['name' => 'admin.checklist'])->syncRoles([$role1, $role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.checklist_model.index'])->syncRoles([$role2, $role3, $role4, $role5]);
        Permission::create(['name' => 'admin.checklist_model.create'])->syncRoles([$role3, $role4, $role5]);
        Permission::create(['name' => 'admin.checklist_model.edit'])->syncRoles([$role3, $role4, $role5]);
        Permission::create(['name' => 'admin.checklist_model.destroy'])->assignRole($role1);
        Permission::create(['name' => 'admin.checklist_model.show'])->syncRoles([$role3, $role4, $role5]);
        Permission::create(['name' => 'admin.checklist_model.elements'])->syncRoles([$role3, $role4, $role5]);
        Permission::create(['name' => 'admin.checklist.generate'])->syncRoles([$role3, $role4, $role5]); */
    }
}
