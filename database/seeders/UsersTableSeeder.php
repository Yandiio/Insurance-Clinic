<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin Admin',
            'email' => 'admin@rs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user2 = User::create([
            'name' => 'Staff 1',
            'email' => 'staff_one@rs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $user3 = User::create([
            'name' => 'Staff 2',
            'email' => 'staff_two@rs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $role = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Staff']);

        $permissions = Permission::pluck('id','id')->all();

        // sync permission
        $role->syncPermissions($permissions);
        $role2->syncPermissions($permissions);

        // assign role into user
        $user->assignRole([$role->id]);
        $user2->assignRole([$role2->id]);
        $user3->assignRole([$role2->id]);
    }
}
