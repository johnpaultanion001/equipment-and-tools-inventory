<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function store(Request $request){
        $validated =  Validator::make($request->all(), [
            'name'   => ['required'],
            'school' => ['required'],
            'intern_id' =>  ['required'],
            'email' =>  ['required', 'unique:users'],
            'google_drive' =>  ['required'],
            'attach_attendance' =>  ['required'],
        ]);
        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $file = $request->file('attach_attendance');
        $extension = $file->getClientOriginalExtension(); 
        $attach_file = $request->input('intern_id')."_".$request->input('name').".".$extension;
        $file->move('assets/attach_attendance/', $attach_file);

        Registration::updateOrCreate(
            [
                'intern_id'  =>  $request->input('intern_id'),
            ],
            [
                'name'  =>  $request->input('name'),
                'school'  =>  $request->input('school'),
                'intern_id'  =>  $request->input('intern_id'),
                'email'  =>  $request->input('email'),
                'google_drive'  =>  $request->input('google_drive'),
                'attach_attendance'  =>  $attach_file,
                'status'  =>  'PENDING',
            ]
        );
        return response()->json(['success' => 'Successfully submited wait for the response of the admin to approve your registration.']);
    }
}
