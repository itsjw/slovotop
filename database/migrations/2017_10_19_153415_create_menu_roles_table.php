<?php
declare(strict_types=1);

use App\Models\MenuRole;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMenuRolesTable
 */
class CreateMenuRolesTable extends Migration
{
    /**
     * @var array
     */
    private $menuRole = ['Админ', 'Сайт'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        foreach ($this->menuRole as $menu) {
            MenuRole::create([
                'name' => $menu,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_roles');
    }
}
