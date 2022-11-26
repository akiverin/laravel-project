<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date')->default('01.01.2023');
            $table->string('name');
            $table->string('preview_image')->nullable();
            $table->string('full_image')->nullable();
            $table->string('shortDesc')->nullable();
            $table->string('desc'); 
            $table->integer('time_read')->nullable();
            $table->integer('views')->nullable(); 
            $table->string('slider')->nullable(); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
