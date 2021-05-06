<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id('question_id');
            $table->string('question_code')->comment('mã câu hỏi');
            $table->string('question_name')->comment('tên câu hỏi');
            $table->enum('question_type', ['radio', 'checkbox', 'textarea'])->comment('loại câu hỏi: radio, checkbox, textarea');
            $table->double('question_scores')->comment('điểm của 1 câu hỏi')->nullable();
            $table->double('question_end_time')->nullable()->comment('thời gian làm của 1 câu hỏi');
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('chapter_id')->references('chapter_id')->on('chapters')->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
}
