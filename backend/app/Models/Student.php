<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'address',
        'contact',
        'course_id',
        'year_level',
        'email',
        'password',
        'image',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
