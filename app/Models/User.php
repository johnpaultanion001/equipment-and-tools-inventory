<?php

namespace App\Models;

use App\Notifications\VerifyUserNotification;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens;

    public $table = 'users';
    
    protected $fillable = [
        'email',
        'email_verified_at',
        
        'password',
        'remember_token',
        
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    public function application()
    {
        return $this->belongsTo(Application::class, 'id', 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
