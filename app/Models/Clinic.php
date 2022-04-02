<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'contact_number',
        'lat',
        'lng',
        'isApproved',
        'business_permit',
        'warning_text',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'clinic_id' , 'id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'clinic_id' , 'id');
    }
}
