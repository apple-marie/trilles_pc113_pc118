<?php

use App\Models\Student;
use App\Mail\NotificationMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;







Artisan::command('exam', function() {
    $students = Student::all();
    foreach($students as $student){
        Mail::to($student->email)->send(new  NotificationMail($student->first_name));      
    }
})->monthlyOn(1, '07:00');

