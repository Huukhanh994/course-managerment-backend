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
	protected $table = 'questions';
	protected $primaryKey = 'question_id';

	protected $casts = [
		'question_scores' => 'float',
		'question_end_time' => 'float',
		'chapter_id' => 'int'
	];

	protected $fillable = [
		'question_code',
		'question_name',
		'question_type',
		'question_scores',
		'question_end_time',
		'chapter_id'
	];

	public function chapter()
	{
		return $this->belongsTo(Chapter::class);
	}

	public function exams()
	{
		return $this->belongsToMany(Exam::class, 'exam_questions')
					->withTimestamps();
	}
}
