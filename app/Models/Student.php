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
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            // this Automatically generate student Id
            $model->trackingReference = $model->generateStudentId();

        });
    }

    // my Mutator to automatically generate a unique studentId
    public function generateStudentId()
    {
        do {
            $studentId = bin2hex(random_bytes(3));
        } while (self::where('studentId', $studentId)->exists());

        $this->attributes['studentId'] = $studentId;
    }
}
