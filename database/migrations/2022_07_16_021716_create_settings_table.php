<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('id')->primary();
            $table->string('co2');
            $table->string('co');
            $table->string('ch4');
            $table->string('temperature');
            $table->string('humidity');
            $table->timestamps();
        });
        //sample data
        DB::table('settings')->insert(
            array(
                [   'id' => '401f0338-f610-41c6-ae19-33168879eeb4',
                    'co2' => '5000',
                    'co' => '50',
                    'ch4' => '2500',
                    'temperature' => '24',
                    'humidity' => '90'
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
        Schema::dropIfExists('settings');
    }
}
