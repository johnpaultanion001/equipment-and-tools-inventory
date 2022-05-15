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

        //WORK AGREEMENT SECTION
        'company_name',
        'company_address',
        'supervisor_name',
        'supervisor_email_address',
        'supervisor_contact_number',
        'current_job_title',
        'give_job_titles',

        //INTERNSHIP REQUIREMENTS CHECKLIST
        'checklist1',
        'checklist2',
        'checklist3',
        'checklist4',
        'checklist5',
        'checklist6',
        'checklist7',
        'checklist8',
        'checklist9',
        'proof_of_attendance',
        'advance_coc',

        // For admin
        'admin_attach_file',

        // step2
        'receive_status',

        // step3
        'answer_video',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
