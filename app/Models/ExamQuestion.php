<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamQuestion
 * 
 * @property int $exam_id
 * @property int $question_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Exam $exam
 * @property Question $question
 *
 * @package App\Models
 */
class ExamQuestion extends Model
{
	protected $table = 'exam_questions';
	public $incrementing = false;

	protected $casts = [
		'exam_id' => 'int',
		'question_id' => 'int'
	];

	protected $fillable = [
		'exam_id',
		'question_id'
	];

	public function exam()
	{
		return $this->belongsTo(Exam::class);
	}

	public function question()
	{
		return $this->belongsTo(Question::class);
	}
}
