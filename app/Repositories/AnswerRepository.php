<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class AnswerRepository extends BaseRepository
{
    protected $table;

    public function model()
    {
        return Answer::class;
    }

    public function getQueryEloquent(): EloquentBuilder
    {
        return Answer::query();
    }

    public function getQueryBuilder(): QueryBuilder
    {
        return DB::table($this->table);
    }

    public function updateAnswer($input, $id)
    {
        return $this->getQueryEloquent()->whereAnswerId($id)->update($input);
    }
}
