<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('avatar',60)->default('');
            $table->tinyInteger('is_validate')->unsigned()->default(0);
            $table->string('validate_token',24)->default('');
            $table->string('password');
            $table->integer('fan_count')->default(0);
            $table->integer('fav_count')->default(0);
            $table->integer('post_count')->default(0);
            $table->string('settings')->nullable();
            $table->enum('provider', ['web', 'mobile', 'github', 'qq', 'wechat'])->default('web');
            $table->string('api_token',60)->default('');
            $table->rememberToken();
            $table->timestamps();
        });
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
