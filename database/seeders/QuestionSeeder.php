<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'question_code' => 'TH-01',
                'question_level' => 'Dễ',
                'question_name' => '1 + 1 bằng mấy?',
                'question_type' => 'checkbox',
                'question_scores' => '0.01',
                'question_end_time' => 1,
                'chapter_id' => 1,
            ],
            [
                'question_code' => 'TH-02',
                'question_level' => 'Dễ',
                'question_name' => '1 + 2 bằng mấy?',
                'question_type' => 'checkbox',
                'question_scores' => '0.01',
                'question_end_time' => 1,
                'chapter_id' => 2,
            ],
            [
                'question_code' => 'TH-03',
                'question_level' => 'Dễ',
                'question_name' => '1 + 3 bằng mấy?',
                'question_type' => 'checkbox',
                'question_scores' => '0.01',
                'question_end_time' => 1,
                'chapter_id' => 3,
            ],
        ];

        foreach ($input as $key => $value) {
            Question::create($value);
        }
    }
}
