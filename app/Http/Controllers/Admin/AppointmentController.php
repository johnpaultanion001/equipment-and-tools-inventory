<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Service;
use Validator;

class AppointmentController extends Controller
{
    
    public function form(Request $request)
    {
        if($request->get('form_type') == "ADD"){
            $service_id = $request->get('service');
            $service = Service::where('id', $service_id)->first();
            $clinic  = Clinic::where('id', $service->clinic_id)->first();
            return response()->json([
                'services'                => $clinic->services()->get(),
                'doctors'                 => $clinic->doctors()->get(),
                'clinic'                  => $clinic->name,
                'warning_text'                  => $clinic->warning_text,
                'service_id'              => $service_id,
            ]);
        }if($request->get('form_type') == "EDIT"){
            $appointment_id = $request->get('appointment');
            
            $appointment = Appointment::where('id', $appointment_id)->first();
            return response()->json([
                'services'                => $appointment->clinic->services()->get(),
                'doctors'                 => $appointment->clinic->doctors()->get(),
                'clinic'                  => $appointment->clinic->name,
                'warning_text'            => $appointment->clinic->warning_text,
                'service_id'              => $appointment->service_id,
                'doctor_id'               => $appointment->doctor_id,
                'date'                    => $appointment->date,
                'time'                    => $appointment->time,
                'note'                    => $appointment->note,
                
            ]);
        }
        
    }

    public function index()
    {
        $appoitments = Appointment::where('user_id', auth()->user()->id)->latest()->get();
        return view('admin.appointments.appointments', compact('appoitments'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'service' => ['required'],
            'doctor'  => ['required'],
            'date' => ['required','after:today'],
            'time' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $service = Service::where('id', $request->input('service'))->first();

        Appointment::create([
            'user_id'       =>  auth()->user()->id,
            'clinic_id'     =>  $service->clinic_id,
            'service_id'    =>  $request->input('service'),
            'doctor_id'     =>  $request->input('doctor'),
            'date'          =>  $request->input('date'),
            'time'          =>  $request->input('time'),
            'note'          =>  $request->input('note'),
        ]);
        
      
        return response()->json(['success' => 'Thank You for a Successful Appointment. Please wait for the Clinic response.']);
    }

    public function update(Request $request, Appointment $appointment)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'service' => ['required'],
            'doctor'  => ['required'],
            'date' => ['required','after:today'],
            'time' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Appointment::find($appointment->id)->update([
            'service_id'    =>  $request->input('service'),
            'doctor_id'     =>  $request->input('doctor'),
            'date'          =>  $request->input('date'),
            'time'          =>  $request->input('time'),
            'note'          =>  $request->input('note'),
        ]);

        return response()->json(['success' => 'Appointment was successfully Updated.']);
    }

    public function destroy(Appointment $appointment)
    {
        date_default_timezone_set('Asia/Manila');

        Appointment::find($appointment->id)->update([
            'status'    =>  'CANCELED',
        ]);

        return response()->json(['success' => 'Appointment was successfully Canceled.']);
    }

}
