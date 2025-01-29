<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstName',
        'middleName',
        'lastName',
        'email',
        'password',
        'age',
        'department',
        'studentId'
    ];

    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            // Automatically generate studentId
            $model->studentId = $model->generateStudentId();
        });
    }
    
    // Mutator to generate a unique 6-digit studentId
    public function generateStudentId()
    {
        do {
            // Generate a random 6-digit integer
            $studentId = rand(100000, 999999);
        } while (self::where('studentId', $studentId)->exists());
    
        return $studentId;
    }
    
}
