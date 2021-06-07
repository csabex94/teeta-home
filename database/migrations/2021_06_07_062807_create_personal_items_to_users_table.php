<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalItemsToUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('personal_items')) {
            Schema::create('personal_items', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->foreignId('user_id')->index();
                $table->foreignId('image_id')->index()->nullable();
                $table->tinyInteger('push_email')->default(0);
                $table->tinyInteger('daily')->default(0);
                $table->tinyInteger('important')->default(0);
                $table->dateTime('spec_date')->nullable();
                $table->time('spec_time')->nullable();
                $table->string('remind_before_value')->nullable();
                $table->string('remind_before_option')->nullable();
                $table->timestamps();
            });
        } 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('personal_items');
    }
}
