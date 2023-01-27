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
        $data_events = Event::select(
            \DB::raw("budget as budgets"),
            \DB::raw("title as titles"))
            ->get();
            
        $result_data_events = [];

        foreach($data_events as $row) {
            $result_data_events['label'][] = $row->titles;
            $result_data_events['data'][] =  $row->budgets;
        }

        $data_results_events = json_encode($result_data_events);

        return view('admin.events.events', compact('events','data_results_events')); 
    }
 
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'category'   => ['required'],
            'title'   => ['required'],
            'budget'   => ['required'],
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
            'budget'     => $request->input('budget'),
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
        if (request()->ajax()) {
            return response()->json(['result' =>  $event]);
        }
    }

    
    public function update(Request $request, Event $event)
    {
        $validated =  Validator::make($request->all(), [
            'category'   => ['required'],
            'title'   => ['required'],
            'location'   => ['required'],
            'budget'   => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $event->update([
            'category'     => $request->input('category'),
            'title'     => $request->input('title'),
            'location'     => $request->input('location'),
            'date'     => $request->input('date') ?? $event->date,
            'time'     => $request->input('time') ?? $event->time,
            'budget'     => $request->input('budget'),
            'description'     => $request->input('description'),
            
        ]);

        return response()->json(['success' => 'Successfully updated!']);
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
