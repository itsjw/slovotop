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
            'icon'    => 'home',
        ]);
        Menu::create([
            'name'    => 'Настройки',
            'slug'    => 'settings',
            'icon'    => 'settings',
        ]);
        Menu::create([
            'name'    => 'Тематика заданий',
            'slug'    => 'subjects',
            'icon'    => 'subject',
        ]);
        Menu::create([
            'name'    => 'Роли и права',
            'slug'    => 'roles',
            'icon'    => 'security',
        ]);
        Menu::create([
            'name'    => 'Пользователи',
            'slug'    => 'users',
            'icon'    => 'group',
        ]);
        Menu::create([
            'name'    => 'Проекты',
            'slug'    => 'projects',
            'icon'    => 'view_carousel',
        ]);
        Menu::create([
            'name'    => 'Задачи',
            'slug'    => 'tasks',
            'icon'    => 'receipt',
        ]);
        Menu::create([
            'name'    => 'Документация',
            'slug'    => 'docs',
            'icon'    => 'insert_drive_file',
        ]);
        Menu::create([
            'name'    => 'Отчеты',
            'slug'    => 'reports',
            'icon'    => 'view_list',
        ]);
    }
}
