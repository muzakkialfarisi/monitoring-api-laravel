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
                $table->integer('main_dealer_id')->nullable();
                $table->string('application_name')->nullable();
                $table->string('application_feature')->nullable();
                $table->string('url')->nullable();
                $table->string('request_header')->nullable();
                $table->string('request_payload')->nullable();
                $table->integer('status_code_factual')->nullable();
                $table->integer('status_code_actual')->nullable();
                $table->boolean('status_code_validation')->nullable();
                $table->string('response_body_factual')->nullable();
                $table->string('response_body_actual')->nullable();
                $table->boolean('response_body_validation')->nullable();
                $table->float('response_time')->nullable();
                $table->float('response_time_accumulation')->nullable();
                $table->boolean('response_time_validation')->nullable();
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
