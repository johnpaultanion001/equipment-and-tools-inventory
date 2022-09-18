<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Validator;

class EventController extends Controller
{
  
    public function index()
    {
        $events = Event::latest()->get();
        return view('admin.events.events', compact('events')); 
    }
 
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'category'   => ['required'],
            'title'   => ['required'],
            'location'   => ['required'],
            'date'   => ['required', 'date' , 'after:today'],
            'time'  => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Event::create([
            'event_id' => 'EVT'.substr(time(), 4),
            'category'     => $request->input('category'),
            'title'     => $request->input('title'),
            'location'     => $request->input('location'),
            'date'     => $request->input('date'),
            'time'     => $request->input('time'),
            'isOpen'    => 'NO',
            'description'     => $request->input('description'),
            
        ]);

        return response()->json(['success' => 'Successfully created!']);
    }
  
    public function show($event)
    {
        $event = Event::where('event_id', $event)->first();
        return view('admin.events.event', compact('event')); 
    }
  
    public function edit(Event $event)
    {
        //
    }

    
    public function update(Request $request, Event $event)
    {
        //
    }

  
    public function destroy(Event $event)
    {
        //
    }

    public function isopen($event){
        $evt = Event::where('event_id', $event)->first();
        if($evt->isOpen == 'YES'){
            $evt->update([
                'isOpen' => 'NO',
            ]);
        }else{
            $evt->update([
                'isOpen' => 'YES',
            ]);
        }
        return response()->json(['success' => 'Successfully changed!']);

    }
}
