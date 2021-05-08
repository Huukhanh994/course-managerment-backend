<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chapter
 * 
 * @property int $chapter_id
 * @property string $chapter_code
 * @property string $chapter_name
 * @property int $subject_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Subject $subject
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class Chapter extends Model
{
	protected $table = 'chapters';
	protected $primaryKey = 'chapter_id';

	protected $casts = [
		'subject_id' => 'int'
	];

	protected $fillable = [
		'chapter_code',
		'chapter_name',
		'subject_id'
	];

	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}

	public function questions()
	{
		return $this->hasMany(Question::class);
	}

	public function examStructures()
	{
		return $this->hasMany(ExamStructure::class, 'chapter_id');
	}
}
