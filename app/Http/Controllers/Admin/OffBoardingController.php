<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use File;

class OffBoardingController extends Controller
{
    public function offboarding(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.offboarding'); 
    }

    public function application(Request $request){

        date_default_timezone_set('Asia/Manila');

        if(auth()->user()->application->image != '')
        {
            $validated =  Validator::make($request->all(), [
                'name'   => ['required'],
                'school' => ['required'],
                'image_file' =>  ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
                'course' => ['required'],
                'contact_number' => ['required', 'string', 'min:8','max:11'],
                'birth_date' => ['required', 'date' , 'before:today'],
                'address' => ['required'],

                'student_advisor' => ['required'],
                'required_hours' => ['required'],
                'schedule' => ['required'],
                'starting_date' => ['required', ],
                'ending_date' => ['required'],
                'consent' => ['accepted'],

            ]);
        }
        else{
            $validated =  Validator::make($request->all(), [
                'name'   => ['required'],
                'school' => ['required'],
                'image_file' =>  ['required','mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
                'course' => ['required'],
                'contact_number' => ['required', 'string', 'min:8','max:11'],
                'birth_date' => ['required', 'date' , 'before:today'],
                'address' => ['required'],

                'student_advisor' => ['required'],
                'required_hours' => ['required'],
                'schedule' => ['required'],
                'starting_date' => ['required', ],
                'ending_date' => ['required'],
                'consent' => ['accepted'],
            ]);
        }

        

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        if($request->file('image_file')){
            $imgs = $request->file('image_file');
            $extension = $imgs->getClientOriginalExtension(); 
            $file_name_to_save = auth()->user()->application->id."_".$request->input('name').".".$extension;
            $imgs->move('assets/applicant_picture/', $file_name_to_save);
        }
        

        Application::where('user_id', auth()->user()->id)->update([
            'status' => 'PENDING',
            'name' => $request->input('name'),
            'school' => $request->input('school'),
            'image' => $file_name_to_save ?? auth()->user()->application->image,
            'course' => $request->input('course'),
            'contact_number' => $request->input('contact_number'),
            'birth_date' => $request->input('birth_date'),
            'address' => $request->input('address'),
            'application_id' => $request->input('application_id'),
            'student_advisor' => $request->input('student_advisor'),
            'advisor_email' => $request->input('advisor_email'),
            'required_hours' => $request->input('required_hours'),
            'schedule' => $request->input('schedule'),
            'starting_date' => $request->input('starting_date'),
            'ending_date' => $request->input('ending_date'),
            'consent' => 1,

        ]);

        return response()->json(['success' => 'Saved Successfully.']);

    }
}
