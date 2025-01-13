<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('ai_analysis_log', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('image_path', 255)->nullable();
            $table->char('success', 1);
            $table->string('message', 255)->nullable();
            $table->integer('class')->length(1)->nullable();
            $table->decimal('confidence', 5, 4)->nullable();
            $table->dateTime('request_timestamp')->length(6)->nullable();
            $table->dateTime('response_timestamp')->length(6)->nullable();


            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('ai_analysis_log');
    }
};
