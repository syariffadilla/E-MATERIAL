<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;



class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.forgot-password');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function resetPasswordToken(string $token){
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function passwordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        return redirect()->back()->with('success', 'Email terkirim silahkan cek email anda . Jika tidak ada cek di bagian spam');
    } else {
        return redirect()->back()->with('error', 'Email anda tidak terdaftar di sistem kami :( ');
    }
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('based')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
