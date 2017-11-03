<?php
declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('confirm')->default(0);
            $table->string('confirm_key')->nullable()->unique();
            $table->string('reset_key')->nullable()->unique();
            $table->float('up_price')->default(0);
            $table->text('note')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@test.ru',
            'password' => bcrypt('111'),
            'confirm'  => true,
        ]);
        User::create([
            'name'     => 'test',
            'email'    => 'test@test.ru',
            'password' => bcrypt('111'),
            'confirm'  => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
