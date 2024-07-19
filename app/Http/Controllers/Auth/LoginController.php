<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Pinpoint;
use App\Models\User;
use App\Models\ProfileToko;

use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['profile'] = ProfileToko::find(1);
        $data['pin'] = Pinpoint::find(1);
        return view('auth.login', $data);
    }

    public function authenticate(Request $request): RedirectResponse
    {


        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $cek_role = User::where('email', $request->email)->first();


        if (!$cek_role) {
            // Email tidak terdaftar
            $request->session()->flash('color', 'warning');
            $request->session()->flash('status', 'Periksa kembali email dan password anda!');
            return redirect('/');
        }


        if ($cek_role->role_is == 2) {
            if($request->jarak >= 300){
                $request->session()->flash('color', 'warning');
                $request->session()->flash('status', 'Login gagal lokasi anda terlalu jauh ' . $request->jarak . 'M dari toko!');
                return redirect('/');
            }
        }

        $login = Auth::attempt($credentials);

        if ($login) {
            $request->session()->regenerate();

            return redirect()->route('dashboard_manager');
        }else{

            $request->session()->flash('color', 'warning');
            $request->session()->flash('status', 'Login gagal periksa kembali email dan password anda!');
            return redirect('/');
        }

    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
