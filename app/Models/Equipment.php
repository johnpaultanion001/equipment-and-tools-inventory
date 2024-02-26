<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'brand',
        'color',
        'quantity',
        'status',
        'available',
        'in_out',
        'reason',
        'note',
    ];
}