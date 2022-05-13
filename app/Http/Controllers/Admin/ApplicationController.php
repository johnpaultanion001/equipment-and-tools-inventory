<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use App\Models\Application;


class ApplicationController extends Controller
{
    public function index(){
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $applications = Application::whereIn('status', ['PENDING', 'APPROVED', 'COMPLETED'])->get();
        return view('admin.applications.application' , compact('applications')); 
    }

    public function full_details(Application $application){
        return view('admin.applications.full_detail' , compact('application')); 
    }
    public function status(Application $application)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $application]);
        }
    }
    public function set_status(Request $request, Application $application){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'status'   => ['required'],
        ]);
        
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        if($request->file('attach_file')){
            $file = $request->file('attach_file');
            $extension = $file->getClientOriginalExtension(); 
            $attach_file = $application->id."_".$application->name.".".$extension;
            $file->move('assets/attach_file/', $attach_file);
        }

        $application->update([
            'status' => $request->input('status'),
            'admin_attach_file' => $attach_file ?? $application->admin_attach_file,
        ]);
        
        return response()->json(['success' => 'Updated Successfully.']);
    }
    
}
