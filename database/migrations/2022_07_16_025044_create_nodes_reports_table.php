<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('alert_id')->nullable();
            $table->string('node_id');
            $table->boolean('btn_warn');
            $table->string('co2');
            $table->string('co');
            $table->string('ch4');
            $table->string('temperature');
            $table->string('humidity');
            $table->string('lat');
            $table->string('lng');
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
        Schema::dropIfExists('nodes_reports');
    }
}
