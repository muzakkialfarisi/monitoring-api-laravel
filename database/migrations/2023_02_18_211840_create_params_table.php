<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('params')) {
            Schema::create('params', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('key');
                $table->string('value')->nullable();
                $table->string('description')->nullable();
                $table->bigInteger('api_id');
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
        Schema::dropIfExists('params');
    }
}
