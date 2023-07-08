<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//      $r1 =   Role::create(['name'=>'admin']);
//      $r2 =   Role::create(['name'=>'redactor']);
//      $r3 =   Role::create(['name'=>'super_user']);
//
//       $p1 = Permission::create(['name'=>'redact']);
//       $p2 = Permission::create(['name'=>'block users']);
//       $p3 = Permission::create(['name'=>'delete posts']);
//       $p4 = Permission::create(['name'=>'block admins']);
//
//
//       $r1->syncPermissions($p1,$p2, $p3);
//
//       $r3->syncPermissions($p1, $p2, $p3, $p4);
//
//       $p1->syncRoles($r1, $r2, $r3);
//       $p2->syncRoles($r1, $r3);
//
//       $p3->syncRoles($r3);
//
//$user = auth()->loginUsingId(1);
//$user->assignRole('super_user');



    }
}
