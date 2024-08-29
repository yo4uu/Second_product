<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_class_id',
        'subject',
        'item_name',
        'item_type',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'school_class_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
