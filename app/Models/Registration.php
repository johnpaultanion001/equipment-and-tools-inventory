<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name',
        'school',
        'intern_id',
        'email',
        'google_drive',
        'attach_attendance',
    ];
}
