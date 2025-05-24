<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable, HasApiTokens;
    
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'address',
        'contact',
        'course_id',
        'year_level',
        'school_year',
        'email',
        'password',
        'image',
        'status'
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
