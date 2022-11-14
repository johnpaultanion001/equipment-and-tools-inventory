<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\AttendEvent;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    
    public function members(){
        $users = User::whereNotIn('id', [1])->latest()->get();
        return view('admin.members.members', compact('users')); 
    }
    public function dashboard(){
        if(auth()->user()->roles()->pluck('id')->implode(', ') == '2'){
            return redirect('/admin/user/events');
        }else if(auth()->user()->roles()->pluck('id')->implode(', ') == '1'){
            $event = Event::latest()->first();
            return redirect('/admin/dashboard/'.$event->event_id);
        }
    }

    public function dashboard_event($event_id){
        $members = User::whereNotIn('id', [1])->count();
        $events = Event::latest()->get();
        $events_attend = AttendEvent::count();

        $event = Event::where('event_id', $event_id)->first();

        return view('admin.dashboard.dashboard', compact('members','events','events_attend','event')); 
    }
  
}
