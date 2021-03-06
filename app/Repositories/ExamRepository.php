<?php

namespace App\Repositories;

use App\Models\Chapter;
use App\Models\Exam;
use App\Models\ExamStructure;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class ExamRepository extends BaseRepository
{
    protected $table;

    public function model()
    {
        return Exam::class;
    }

    public function getQueryEloquent(): EloquentBuilder
    {
        return Exam::query();
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return DB::table($this->table);
    }

    public function prepareData()
    {
        $data['questions'] = Question::all();
        $data['examStructures'] = ExamStructure::select('exam_structure_name')->groupBy('exam_structure_name');

        return $data;
    }

    public function storeExam($input)
    {
        $exam = $this->getQueryEloquent()->create($input);

        $exam->questions()->sync($input['question_id']);

        return $exam;
    }

    public function updateExam($input, $id)
    {
        return $this->getQueryEloquent()->whereExamId($id)->update($input);
    }
}
