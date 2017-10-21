<?php

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@test.ru',
            'password' => bcrypt('111'),
            'confirm'  => true,
        ]);

        UserRole::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        User::create([
            'name'     => 'Test',
            'email'    => 'test@test.ru',
            'password' => bcrypt('111'),
            'confirm'  => true,
        ]);

        UserRole::create([
            'user_id' => 2,
            'role_id' => 2,
        ]);

        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'Семантик',
        ]);
    }
}
