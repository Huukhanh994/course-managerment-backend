<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $subject_id
 * @property string $subject_code
 * @property string $subject_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property Collection|Chapter[] $chapters
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subjects';
	protected $primaryKey = 'subject_id';

	protected $fillable = [
		'subject_code',
		'subject_name'
	];

	public function chapters()
	{
		return $this->hasMany(Chapter::class,'subject_id');
	}
}
