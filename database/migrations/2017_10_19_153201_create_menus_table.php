<?php
declare(strict_types=1);

use App\Models\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMenusTable
 */
class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->integer('role_id')->default(1);
            $table->integer('parent_id')->default(0);
            $table->timestamps();
        });

        $this->seedMenu();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }

    /**
     * add menus
     */
    private function seedMenu()
    {
        Menu::create([
            'name'    => 'Главная',
            'slug'    => 'home',
            'icon'    => 'home',
            'role_id' => 1,
        ]);
        Menu::create([
            'name'    => 'Настройки',
            'slug'    => 'settings',
            'icon'    => 'settings',
            'role_id' => 1,
        ]);
        Menu::create([
            'name'    => 'Роли и права',
            'slug'    => 'roles',
            'icon'    => 'security',
            'role_id' => 1,
        ]);
        Menu::create([
            'name'    => 'Пользователи',
            'slug'    => 'users',
            'icon'    => 'group',
            'role_id' => 1,
        ]);
        Menu::create([
            'name'    => 'Проекты',
            'slug'    => 'projects',
            'icon'    => 'view_carousel',
            'role_id' => 1,
        ]);
        Menu::create([
            'name'    => 'Задачи',
            'slug'    => 'tasks',
            'icon'    => 'receipt',
            'role_id' => 1,
        ]);

        // user menu
        Menu::create([
            'name'    => 'Главная',
            'slug'    => 'home',
            'icon'    => 'home',
            'role_id' => 2,
        ]);
        Menu::create([
            'name'    => 'Настройки',
            'slug'    => 'settings',
            'icon'    => 'settings',
            'role_id' => 2,
        ]);
        Menu::create([
            'name'    => 'Проекты',
            'slug'    => 'projects',
            'icon'    => 'view_carousel',
            'role_id' => 2,
        ]);
    }
}
