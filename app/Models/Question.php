<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * 
 * @property int $question_id
 * @property string $question_code
 * @property string $question_name
 * @property string $question_type
 * @property float $question_scores
 * @property float $question_end_time
 * @property int $chapter_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Chapter $chapter
 * @property Collection|Exam[] $exams
 *
 * @package App\Models
 */
class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $fillable = ['question_code', 'question_level', 'question_name', 'question_type', 'question_scores', 'question_end_time', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions', 'question_id', 'exam_id');
    }
}
