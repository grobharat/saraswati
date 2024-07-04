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
        Schema::create('master_topics', function (Blueprint $table) {
            $table->id();
            $table->string('serialnumber');
            $table->string('title');
            $table->string('description');
            $table->integer('weightage');
            $table->integer('timerequired')->comment('minutes for completion');
            $table->integer('parentid');  //this topic belongs to which chapter of upar hierarchy
            $table->integer('contentid'); //content related to topic can be found at reference link
            $table->string('tags');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_topics');
    }
};
