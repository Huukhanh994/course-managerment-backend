<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Exam
 * 
 * @property int $exam_id
 * @property string $exam_code
 * @property string $exam_name
 * @property string $exam_type
 * @property string $exam_end_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $primaryKey = 'exam_id';
    protected $fillable = ['exam_code', 'exam_name', 'exam_type', 'exam_end_time', 'exam_structure_id'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'exam_id');
    }

    public function examStructure()
    {
        return $this->belongsTo(ExamStructure::class, 'exam_structure_id');
    }
}
