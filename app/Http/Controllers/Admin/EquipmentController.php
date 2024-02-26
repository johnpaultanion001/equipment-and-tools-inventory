<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{

    public function index()
    {
        $equipments = Equipment::latest()->get();
        $brands = Equipment::select('brand')->orderBy('brand')->groupBy('brand')->latest()->get();
        $colors =  Equipment::select('color')->orderBy('color')->groupBy('color')->latest()->get();
        return view('admin.equipments.equipments', compact('equipments','brands','colors'));
    }

    public function equipments(Request $request)
    {
        $search = $request->get('search');
        $brand = $request->get('filter_brand');
        $color = $request->get('filter_color');

        $q = Equipment::query();
        if (isset($search))
        {
           $q = $q->where('item' , 'LIKE', '%'.$search.'%');
        }
        if (isset($brand))
        {
            $q = $q->where('brand', $brand);
        }
        if (isset($color))
        {
            $q = $q->where('color', $color);
        }
        $equipments = $q->latest()->get()->toArray();

        return response()->json(
            [
                'messages' => 'Successfully loaded',
                'data' => $equipments
            ]
        );

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        //
    }
}
