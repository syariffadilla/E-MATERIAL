<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileToko;
use File;

class ProfileTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user'] = AUTH::user(); 

        $data['profile'] = ProfileToko::find(1);
        $data['title'] = [
            'title' => 'Profile Toko',
            'keterangan' => 'Di menu ini anda dapat mengubah data toko'
        ];
        return view('manager.profile_toko.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $current_data = ProfileToko::find(1);
        $file = $request->file('logo');
        if($file){
            $tujuan_upload = 'logo';
            $file->move($tujuan_upload,$file->getClientOriginalName());
            File::delete(public_path('logo/'. $current_data->logo));
            $current_data->logo = $file->getClientOriginalName();
        }
        $current_data->nama_toko = $request->nama_toko;
        $current_data->alamat = $request->alamat;
        $current_data->telp = $request->telp;
        $current_data->save();
        // dd($current_data);
        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Edit profile toko berhasil');
        
        return redirect()->back();


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
