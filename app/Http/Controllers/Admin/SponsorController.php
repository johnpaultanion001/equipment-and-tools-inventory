<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Validator;
use File;


class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::where('isRemove', 0)->latest()->get();
        return view('admin.sponsors.sponsors', compact('sponsors'));
    }

   
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'image' =>  ['required' , 'mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $imgs = $request->file('image');
        $extension = $imgs->getClientOriginalExtension(); 
        $file_name_to_save = time()."_".$request->input('title').".".$extension;
        $imgs->move('assets/img/sponsors/', $file_name_to_save);

        Sponsor::create([
            'title' => $request->input('title'),
            'image' => $file_name_to_save,
        ]);

        return response()->json(['success' => 'Sponsor Added Successfully.']);
    }

    public function edit(Sponsor $sponsor)
    {
        if (request()->ajax()) {
            return response()->json(['result' =>  $sponsor]);
        }
    }
    public function update_sponsor(Request $request, Sponsor $sponsor)
    {
         $validated =  Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'image' =>  ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        if ($request->file('image')) {
            File::delete(public_path('assets/img/sponsors/'.$sponsor->image));
            $imgs = $request->file('image');
            $extension = $imgs->getClientOriginalExtension(); 
            $file_name_to_save = time()."_".$request->title.".".$extension;
            $imgs->move('assets/img/sponsors/', $file_name_to_save);
            $sponsor->image = $file_name_to_save;
        }
       
        $sponsor->title = $request->title;
        $sponsor->save();

        return response()->json(['success' => 'Sponsor Updated Successfully.']);
    }
    
    public function destroy(Sponsor $sponsor)
    {
        File::delete(public_path('assets/img/sponsors/'.$sponsor->image));
        $sponsor->update([
            'isRemove'  => '1',
        ]);
        return response()->json(['success' =>  'Sponsor Removed Successfully.']);
    }
}
