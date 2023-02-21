<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('api')) {
            Schema::create('api', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('aplikasi_id');
                $table->bigInteger('header_id')->nullable();
                $table->bigInteger('version_id')->nullable();
                $table->string('path_url')->nullable();
                $table->timestamps(DB::raw(0));
                $table->dateTime('deleted_at', DB::raw(0))->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api');
    }
}
