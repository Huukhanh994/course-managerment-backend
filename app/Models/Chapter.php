<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapters';

    protected $primaryKey = 'chapter_id';

    protected $fillable = ['chapter_code', 'chapter_name'];

    public function questions()
    {
        return $this->hasMany(Question::class, 'chapter_id');
    }
}
