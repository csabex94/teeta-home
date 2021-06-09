<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->foreignId('user_id')->index();
            $table->tinyInteger('push_email')->default(0);
            $table->tinyInteger('daily')->default(0);
            $table->tinyInteger('important')->default(0);
            $table->tinyInteger('completed')->default(0);
            $table->dateTime('spec_date')->nullable();
            $table->time('spec_time')->nullable();
            $table->string('remind_before_value')->nullable();
            $table->string('remind_before_option')->nullable();
            $table->boolean('keep_in_list')->default(0);
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
        Schema::dropIfExists('events');
    }
}
