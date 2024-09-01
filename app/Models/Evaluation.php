<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_item_id',
        'score',
        'comment',
        'student_id', 
    ];

    public function evaluationItem()
    {
        return $this->belongsTo(EvaluationItem::class, 'evaluation_item_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
