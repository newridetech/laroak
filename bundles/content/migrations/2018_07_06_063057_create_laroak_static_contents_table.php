<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaroakStaticContentsTable extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('laroak_static_contents');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laroak_static_contents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('owner_id')->unique();
            $table->json('data');
            $table->string('locale');
            $table->timestamps();
        });
    }
}
