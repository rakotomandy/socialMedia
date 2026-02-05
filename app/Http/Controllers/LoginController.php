<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:login,email',
            'password' => 'required|min:4|confirmed',
        ]);

        Login::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       if(Auth::guard('login')->attempt($request->only('email', 'password'))){
            $request->session()->regenerate();
            return redirect()->route('home');
       }
       return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $request->validate([    
            'email' => 'required|email|exists:login,email',
        ]);

        if(Login::where('email', $email)->exists()){
            return redirect()->route('password.reset', ['token' => Password::createToken(Login::where('email', $email)->first()), 'email' => $email])->with('success', 'Password reset link has been sent to your email address.');
        }else{
            return back()->withErrors(['email' => 'Email address not found.']);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed',
        ]);

        Login::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Password has been reset successfully. Please login with your new password.');
    }

    public function logout(Request $request)
    {
        Auth::guard('login')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
