<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('logs')) {
            Schema::create('logs', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('application_name');
                $table->string('application_feature');
                $table->string('url');
                $table->string('request_header');
                $table->string('request_payload');
                $table->string('status_code_factual');
                $table->string('status_code_actual');
                $table->boolean('status_code_validation');
                $table->string('response_body_factual');
                $table->string('response_body_actual');
                $table->boolean('response_body_validation');
                $table->string('response_time');
                $table->string('response_time_accumulation');
                $table->boolean('response_time_validation');
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
        if (Schema::hasTable('logs')) {
            Schema::dropIfExists('logs');
        }
    }
}
