<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\BudgetEvent;
use Validator;
use File;


class BudgetController extends Controller
{
    public function index()
    {
        $events = Event::where('isRemove', 0)->latest()->get();
        return view('admin.budgets.budgets', compact('events'));
    }


    public function store(Request $request)
    {
        
        BudgetEvent::where('event_id', $request->input('event_id'))
                    ->whereNotIn('title', $request->input('budget'))
                    ->delete();

        foreach($request->input('budget') as $budget )
        {
            BudgetEvent::updateOrCreate(
                [
                    'event_id'            => $request->input('event_id'),
                    'title'               => $budget,
                ],
                [
                    'event_id'            => $request->input('event_id'),
                    'title'               => $budget,
                ]
            );
        }

        return response()->json(['success' => 'Successfully Updated.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($budget)
    {
        $data = Event::where('event_id', $budget)->first();

        foreach($data->budgets()->get() as $budget){
            $budgets[] = array(
                'title'        => $budget->title, 
            );
        }

        return response()->json([
            'title' =>  $data->title ?? '',
            'budgets'  => $budgets ?? '',
        ]);
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
