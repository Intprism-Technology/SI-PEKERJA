<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        //sample data
        DB::table('users')->insert(
            array(
                [   'id' => '5f3c9142-f79c-4db3-8bf7-7660c5f2b949',
                    'name' => 'Muhammad Habib Ulil A',
                    'email' => 'habibulilalbaab@intprism.com',
                    'email_verified_at' => null,
                    'password' => '$2y$10$gcr3XF3hofwmu6vKTM9C/O8HAiVBwikgAorYBsdKrVumudm4Yi1Q.'
                ],
            )
        );
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
