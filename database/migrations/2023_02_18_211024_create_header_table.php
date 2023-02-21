<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('header')) {
            Schema::create('header', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('header_authorization_id')->nullable();
                $table->bigInteger('header_content_type_id')->nullable();
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
        if (Schema::hasTable('header')) {
            Schema::dropIfExists('header');
        }
    }
}
