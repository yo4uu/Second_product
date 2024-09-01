<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'school_grade',
        'school_year',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_memberships');
    }
    
    public function evaluationItems()
    {
        return $this->hasMany(EvaluationItem::class);
    }

    
}
