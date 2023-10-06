<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ChecklistUser;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@mail.com',
            'identification' => '0000000',
            'position' => 'System Administrator',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
            ])
            ->givePermissionTo([
                'checklist-model.index', 'checklist-model.create', 'checklist-model.edit', 'checklist-model.show',
                'checklist-model.destroy',
                'checklist-model.clone', 'element-model.index', 'element-model.create', 'element-model.edit',
                'element-model.destroy', 'checklist.index', 'checklist.create', 'checklist.show',
                'checklist.first-edit', 'checklist.second-edit', 'checklist.first-verify-edit',
                'checklist.second-verify-edit', 'checklist.interchange', 'checklist.checklist-by-user', 'checklist.pdf',
                'checklist.expired', 'checklist.enable',
                'user.index', 'user.create', 'user.edit', 'user.show', 'user.destroy',
                'user.edit-password', 'user.edit-permission', 'user.show-deleted-user', 'user.list-all-users', 'log.show'
            ]);

        User::create([
            'name' => 'Gabriel Peñaranda G.',
            'email' => 'gpenarandag@gmail.com',
            'identification' => '7408921',
            'position' => 'Consultor',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo(['checklist-model.index','checklist-model.create','checklist-model.edit','checklist-model.show',
                'checklist-model.destroy', 'checklist-model.clone', 'element-model.index','element-model.create','element-model.edit','element-model.destroy',
                'checklist.index','checklist.create','checklist.show','checklist.first-edit',
                'checklist.second-edit', 'checklist.first-verify-edit', 'checklist.second-verify-edit', 'checklist.interchange',
                'checklist.checklist-by-user', 'checklist.pdf',
                'checklist.expired', 'checklist.enable',
                'user.index', 'user.create','user.edit','user.show','user.destroy', 'user.edit-password',
                'user.edit-permission', 'user.show-deleted-user', 'user.list-all-users', 'log.show'
            ]);

        User::create([
            'name' => 'Juan Lazo',
            'email' => 'jlazo@mail.com',
            'identification' => '7575757',
            'position' => 'Camarero',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo(['checklist.index', 'checklist.show', 'checklist.first-verify-edit',
                'checklist.second-verify-edit', 'checklist.interchange'
            ]);

        User::create([
            'name' => 'Luisa Pérez',
            'email' => 'lperez@mail.com',
            'identification' => '9653214',
            'position' => 'Camarera',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo([
            'checklist-model.index', 'checklist-model.create', 'checklist-model.show', 'element-model.index',
            'element-model.create', 'element-model.edit', 'element-model.destroy',
            'checklist.index', 'checklist.create', 'checklist.show', 'checklist.first-verify-edit',
            'checklist.second-verify-edit', 'checklist.interchange',
        ]);

        User::create([
            'name' => 'Henry Ortíz',
            'email' => 'hortiz@xmail.com',
            'identification' => '20653214',
            'position' => 'Camarero',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo([
            'checklist-model.index', 'checklist-model.create', 'checklist-model.show', 'element-model.index',
            'element-model.create', 'element-model.edit', 'element-model.destroy',
            'checklist.index', 'checklist.show', 'checklist.first-verify-edit',
            'checklist.second-verify-edit',
        ]);

        User::create([
            'name' => 'Temistocles Blanco',
            'email' => 'teblan@yahoo.com',
            'identification' => '15845214',
            'position' => 'Jefe',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo([
            'checklist-model.index', 'checklist-model.create', 'checklist-model.show', 'element-model.index',
            'element-model.create', 'element-model.edit', 'element-model.destroy',
            'checklist.index', 'checklist.show', 'checklist.first-verify-edit',
            'checklist.second-verify-edit',
        ]);

        User::create([
            'name' => 'Crispin Gonzalez',
            'email' => 'crisping@yahoo.com',
            'identification' => '6999666',
            'position' => 'Gerente',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo([
            'checklist-model.index', 'checklist-model.create', 'checklist-model.show', 'element-model.index',
            'element-model.create', 'element-model.edit', 'element-model.destroy',
            'checklist.index', 'checklist.show', 'checklist.first-verify-edit',
            'checklist.second-verify-edit',
        ]);

        User::create([
            'name' => 'Debora Beltran',
            'email' => 'beltran@gmail.com',
            'identification' => '6333696',
            'position' => 'Cajera',
            'password' => bcrypt('123456789'),
            'first' => 0,
            'second' => 0,
            'date_to' => Carbon::now(),
        ])->givePermissionTo([
            'checklist-model.index', 'checklist-model.create', 'checklist-model.show', 'element-model.index',
            'element-model.create', 'element-model.edit', 'element-model.destroy',
            'checklist.index', 'checklist.show', 'checklist.first-verify-edit',
            'checklist.second-verify-edit',
        ]);

        // User::factory(3)->create();
    }
}
