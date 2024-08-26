<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'date_of_birth',
        'sex',
        'adress',
        'admission_year',
        'email',
    ];

    public function schoolClasses()
    {
        return $this->belongsToMany(SchoolClass::class, 'class_memberships');
    }
}
