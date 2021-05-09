<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamStructure extends Model
{
    use HasFactory;

    protected $table = 'exam_structures';

    protected $primaryKey = 'exam_structure_id';

    protected $fillable = ['exam_structure_quantity', 'exam_structure_name', 'exam_structure_ez', 'exam_structure_me', 'exam_structure_ha', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'exam_structure_id');
    }
}
