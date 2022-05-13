<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterEmail;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class RegisterEmailController extends Controller
{
    public function index(){
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $emails = RegisterEmail::latest()->get();
        return view('admin.register_emails' , compact('emails')); 
    }

    public function store(Request $request){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'email' => ['required' , 'unique:register_emails'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        RegisterEmail::create([
            'email' => $request->input('email'),
        ]);

        return response()->json(['success' => 'Successfully Added Record.']);
    }

    public function edit(RegisterEmail $email)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $email]);
        }
    }

    public function update(Request $request, RegisterEmail $email)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'email' => ['required' , 'unique:register_emails'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $email->find($email->id)->update([
            'email' => $request->input('email'),
        ]);

        return response()->json(['success' => 'Updated Successfully.']);
    }
    

    public function destroy(RegisterEmail $email)
    {
        $email->delete();
        return response()->json(['success' =>  'Removed Successfully.']);
    }
}
