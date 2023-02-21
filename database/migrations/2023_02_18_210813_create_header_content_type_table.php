<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeaderContentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('header_content_type')) {
            Schema::create('header_content_type', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('content_type_id');
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
        if (Schema::hasTable('header_content_type')) {
            Schema::dropIfExists('header_content_type');
        }
    }
}
