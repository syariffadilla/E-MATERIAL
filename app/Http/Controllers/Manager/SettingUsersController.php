<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['pengguna'] =  User::all()->ToArray();
        $data['user'] = AUTH::user(); 
        $data['title'] = [
            'title' => 'Setting Users',
            'keterangan' => 'Di menu ini anda dapat menghapus ataupun mengedit pengguna aplikasi'
        ];

      
        // dd($data['pengguna']);
        return view('manager.setting_user.index', $data);
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
        $this->validate($request, [
            'email' => 'email|unique:users',     
        ]);
       $password = Hash::make($request->password);
       
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_is = $request->role;
        $user->password = $password;
        $user->save();


        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Tambah user berhasil');
        
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
        // $this->validate($request, [
        //     'email' => 'email|unique:users',     
        // ]);
       $password = Hash::make($request->password);
       
       if($request->password == ""){
        $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_is = $request->role;
            $user->save();
       }else{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_is = $request->role;
            $user->password = $password;
            $user->save();
       }
       


        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Edit user berhasil');
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        $request->session()->flash('color', 'success');
        $request->session()->flash('status', 'Hapus user berhasil');
        
        return redirect()->back();
    }
}
