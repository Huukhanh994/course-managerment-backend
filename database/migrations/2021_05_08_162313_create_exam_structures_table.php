<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_structures', function (Blueprint $table) {
            $table->id('exam_structure_id');
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('chapter_id')->references('chapter_id')->on('chapters')->onDelete('cascade');
            $table->string('exam_structure_name')->nullable();
            $table->integer('exam_structure_quantity')->nullable();
            $table->integer('exam_structure_ez')->nullable();
            $table->integer('exam_structure_me')->nullable();
            $table->integer('exam_structure_ha')->nullable();
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
        Schema::dropIfExists('exam_structures');
    }
}
