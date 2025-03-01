<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];
}
