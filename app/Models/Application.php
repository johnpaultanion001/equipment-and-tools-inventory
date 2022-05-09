<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        //INTERN INFORMATION
        'status',
        'user_id',
        'image',
        'name',
        'school',
        'course',
        'contact_number',
        'birth_date',
        'address',
        'application_id',
        'student_advisor',
        'advisor_email',
        'required_hours',
        'schedule',
        'starting_date',
        'ending_date',
        'consent',
        

    ];
}
