<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Application;
use App\Models\RegisterEmail;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


use File;

class RegisterController extends Controller
{
  
    use RegistersUsers;

  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $emails = RegisterEmail::latest()->get();
        foreach ($emails as $email) {
            $r_email[] = array(
                $email->email,
            );
        }

        return Validator::make($data,
            [
                'name'   => ['required'],
                'contact_number'   => ['required', 'string', 'min:8','max:11'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 
                                'exists:register_emails,email'],
                'password' => ['required', 'string' ,'confirmed'
                                ,'min:8'],
            ], ['email.exists' => 'The input email address is invalid, contact the administration to verify your email address.']);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        Application::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'contact_number' => $data['contact_number'],
        ]);
        RoleUser::insert([
            'user_id' => $user->id,
            'role_id' => 2,
        ]);

        return $user;
      
      
    }

    public function redirectPath(){
        return route('admin.user.home');
    }
}
