<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\Event;
use App\Models\AttendEvent;

class UsersController extends Controller
{

    public function events(){
        $events = Event::latest()->where('isOpen', 'YES')->get();
        return view('user.events.events', compact('events')); 
    }

    public function store_event(Request $request, $event){
        AttendEvent::updateOrCreate(
            [
                'event_id' => $event,
                'user_id'  => auth()->user()->id,
            ],
            [
                'event_id' => $event,
                'user_id'  => auth()->user()->id,
            ]
        );
        return response()->json(['success' => 'Successfully attended!']);
    }
    public function event($event){
        $event = Event::where('event_id', $event)->first();
        return view('user.events.event', compact('event')); 
    }
    public function history(){
        $event_attend = AttendEvent::where('user_id', auth()->user()->id)->latest()->get();
        return view('user.history.history', compact('event_attend')); 
    }
    
    public function account(User $user){

        return view('user.account.account', compact('user')); 
        
    }

    public function update_account(User $user, Request $request){
        $validated =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'unique:users,email,'.$user->id],
            'contact_number' => ['required', 'string', 'min:8','max:11'],
            'address' => ['required'],
            
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function update_pass(Request $request , User $user)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'current_password' => ['required',new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['required','same:new_password'],
           
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        User::find($user->id)->update([
            
            'password' => Hash::make($request->input('new_password')),
          
        ]);
        return response()->json(['success' => 'Updated Successfully.']);
    }

    
    

}
