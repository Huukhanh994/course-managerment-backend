<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
	protected $table = 'exams';
	protected $primaryKey = 'exam_id';

	protected $fillable = [
		'exam_code',
		'exam_name',
		'exam_type',
		'exam_end_time'
	];

	public function questions()
	{
		return $this->belongsToMany(Question::class, 'exam_questions')
					->withTimestamps();
	}
}
