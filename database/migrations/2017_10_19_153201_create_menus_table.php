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
            $table->integer('refer')->default(1);
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
            'icon'    => 'fa-home',
        ]);
        Menu::create([
            'name'    => 'Настройки',
            'slug'    => 'settings',
            'icon'    => 'fa-cogs',
        ]);
        Menu::create([
            'name'    => 'Тематика',
            'slug'    => 'subjects',
            'icon'    => 'fa-align-justify',
        ]);
        Menu::create([
            'name'    => 'Роли и права',
            'slug'    => 'roles',
            'icon'    => 'fa-shield',
        ]);
        Menu::create([
            'name'    => 'Пользователи',
            'slug'    => 'users',
            'icon'    => 'fa-users',
        ]);
        Menu::create([
            'name'    => 'Проекты',
            'slug'    => 'projects',
            'icon'    => 'fa-th-list',
        ]);
        Menu::create([
            'name'    => 'Задачи',
            'slug'    => 'tasks',
            'icon'    => 'fa-tasks',
        ]);
        Menu::create([
            'name'    => 'Документация',
            'slug'    => 'docs',
            'icon'    => 'fa-file-text',
        ]);
        Menu::create([
            'name'    => 'Отчеты',
            'slug'    => 'reports',
            'icon'    => 'fa-bar-chart',
        ]);
    }
}
