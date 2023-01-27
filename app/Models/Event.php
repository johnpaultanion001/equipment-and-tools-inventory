<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $dates = [
        'date',
        'time',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'event_id',
        'category',
        'title',
        'location',
        'date',
        'time',
        'isOpen',
        'description',
        'isRemove',
        'budget',
        'created_at',
        'updated_at',
    ];

    public function attended()
    {
        return $this->hasMany(AttendEvent::class, 'event_id','event_id');
    }

    public function budgets()
    {
        return $this->hasMany(BudgetEvent::class, 'event_id','event_id');
    }
}
