<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            // 'g-recaptcha-response' => 'required|captcha'
        ]);
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

         $this->clearLoginAttempts($request);

         if ($response = $this->authenticated($request, $this->guard()->user())) {
             return $response;
            }

            
         if(Auth::user()->roles()->pluck('id')->implode(', ') == '2'){
             $redirectTo = '/admin/user/events';
         }else if(Auth::user()->roles()->pluck('id')->implode(', ') == '1'){
             $redirectTo = '/admin/dashboard';
         }

         return $request->wantsJson()
                     ? new JsonResponse([], 204)
                     : redirect($redirectTo);
     }
}
