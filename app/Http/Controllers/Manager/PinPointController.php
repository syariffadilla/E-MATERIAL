<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pinpoint;
use Illuminate\Support\Facades\Auth;

class PinPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pinPoint'] = Pinpoint::find(1);
        $data['user'] = AUTH::user();
        $data['title'] = [
            'title' => 'Pin Point Posisi Toko',
            'keterangan' => 'Menu untuk set lokasi toko anda'
        ];

     

        return view('manager.pinpoint.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       $save = Pinpoint::find(1);
       $save->lat = $request->lat;
       $save->lng = $request->lng;
       $save->save();


       $request->session()->flash('color', 'success');
       $request->session()->flash('status', 'Lokasi berhasil di tetapkan');
       
       return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
