<?php
declare(strict_types=1);

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSettingsTable
 */
class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('value')->nullable();
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
        Schema::dropIfExists('settings');
    }

    /**
     * add menus
     */
    private function seedMenu()
    {
        Setting::create([
            'name' => 'editor',
        ]);
        Setting::create([
            'name' => 'author',
        ]);
    }
}
