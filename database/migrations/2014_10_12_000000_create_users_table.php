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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('is_admin')->default(0);
            $table->integer('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insertOrIgnore([
            'name' => 'admin',
            'email' => 'admin@mail.ie',
            'password' => '$2y$10$WWidwaoWbcf/E374nRYvN.rjgJEHAYGjRWEdxVO5lZtXb1eZHn8tm',
            'is_admin' => '1'
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
