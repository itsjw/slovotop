<?php

use App\Models\Menu;
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
        // add user
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
        // add user role
        Role::create([
            'name' => 'Admin',
        ]);
        Role::create([
            'name' => 'Семантик',
        ]);

        // admin menu
        Menu::create([
            'name'      => 'Главная',
            'slug'      => 'home',
            'icon'      => 'home',
            'role_id'   => 1,
        ]);
        Menu::create([
            'name'      => 'Настройки',
            'slug'      => 'settings',
            'icon'      => 'settings',
            'role_id'   => 1,
        ]);
        Menu::create([
            'name'      => 'Пользователи',
            'slug'      => 'users',
            'icon'      => 'group',
            'role_id'   => 1,
        ]);
        Menu::create([
            'name'      => 'Проекты',
            'slug'      => 'projects',
            'icon'      => 'view_carousel',
            'role_id'   => 1,
        ]);
        Menu::create([
            'name'      => 'Задачи',
            'slug'      => 'tasks',
            'icon'      => 'receipt',
            'role_id'   => 1,
        ]);
    }
}
