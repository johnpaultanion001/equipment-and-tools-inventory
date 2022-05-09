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
use File;

class UsersController extends Controller
{

    public function home(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.home'); 
    }

    public function index()
    {
        abort_if(Gate::denies('admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accounts = RoleUser::whereIn('role_id',['1'])->get();

        return view('administration.accounts.accounts', compact('accounts'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'string', 'min:8'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        $account = User::create([
            'email'  => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'isApproved'          => 1,
            'email_verified_at'     => date("Y-m-d H:i:s"),
        ]);
        RoleUser::insert([
            'user_id' => $account->id,
            'role_id' => 1,
        ]);
        return response()->json(['success' => 'Added Successfully.']);

    }

    public function edit(User $account)
    {
        $role = RoleUser::where('user_id', $account->id)->first();

        if (request()->ajax()) {
            return response()->json([
                'email'              => $account->email,
            ]);
        }
    }

    public function update(Request $request, User $account)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email,' .$account->id,],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        User::find($account->id)->update([
            'email'  => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        return response()->json(['success' => 'Updated Successfully.']);
    }

   

    public function destroy(User $account)
    {
        RoleUser::where('user_id',$account->id)->delete();
        return response()->json(['success' => $account->delete()]);
    }

    public function changepassword()
    {
        return view('admin.change_password.change_password');

    }
    public function passwordupdate(Request $request , User $user){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'current_password' => ['required',new MatchOldPassword],
            'new_password' => ['required','min:8'],
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

    public function edit_account(Request $request){
        return view('admin.edit_account.edit_account');
    }

    public function edit_account_update(Request $request, $account){
        if(auth()->user()->roles()->pluck('id')->implode(', ') == 2){
            $validated =  Validator::make($request->all(), [
                'name'             => ['required'],
                'contact_number'   => ['required', 'numeric' ],
                'address'          => ['required'],
                'lat'              => ['required'],
                'lng'              => ['required'],
                'business_permit'  =>  ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
            ]); 

            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }

            $clinic = Clinic::where('id', $account)->first();

            if ($request->file('business_permit')) {
                File::delete(public_path('assets/images/business_permit/'.$clinic->business_permit));
                $imgs = $request->file('business_permit');
                $extension = $imgs->getClientOriginalExtension(); 
                $file_name_to_save = time()."_".auth()->user()->id.".".$extension;
                $imgs->move('assets/images/business_permit/', $file_name_to_save);
                $clinic->business_permit = $file_name_to_save;
            }
           
            $clinic->name = $request->name;
            $clinic->contact_number = $request->contact_number;
            $clinic->address = $request->address;
            $clinic->lat = $request->lat;
            $clinic->lng = $request->lng;
            $clinic->warning_text = $request->warning_text;
            $clinic->save();
        }
        else if(auth()->user()->roles()->pluck('id')->implode(', ') == 3){
            $validated =  Validator::make($request->all(), [
                'name'   => ['required'],
                'contact_number'   => ['required', 'numeric' ],
                'address'   => ['required'],
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }

            Client::find($account)->update([
                'name'  => $request->input('name'),
                'contact_number'  => $request->input('contact_number'),
                'address'  => $request->input('address'),
            ]);
        }


        return response()->json(['success' => 'Updated Successfully.']);
    }

}
