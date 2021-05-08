<?php

namespace App\Repositories;

use App\Models\Chapter;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class QuestionRepository extends BaseRepository
{
    protected $table;

    public function model()
    {
        return Question::class;
    }

    public function getQueryEloquent(): EloquentBuilder
    {
        return Question::query();
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return DB::table($this->table);
    }

    public function prepareData()
    {
        $data['subjects'] = Subject::all();
        $data['chapters'] = Chapter::all();

        return $data;
    }
}
