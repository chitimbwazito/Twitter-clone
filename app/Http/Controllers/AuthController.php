<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Laravel\Sanctum\PersonalAccessToken;



class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function store()
    {
        request()->validate([
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = new User([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
        Mail::to($user->email)->send(new WelcomeEmail($user));

        $user->save();

        if(request()->expectsJson()){
            return response()->json(
            [
                'message'=> 'user created successfully',
                'status code'=> 200,
            ]);
            }

        return redirect()->route('dashboard')->with('success', 'Account successfully created');
    }

    public function login()
    {
        return view('auth.login');
    }
    public function authenticate()
    {


        if(request()->expectsJson()){
            $validated = request()->validate([
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);
            if (Auth::attempt($validated)) {
                $user = Auth::user();

                // Generate a Sanctum token for the user
                $token = $user->createToken('POS-Access-Token')->plainTextToken;
            return response()->json(
            [
                'message'=> 'login successful',
                'status code'=> 200,
                'token'=> $token,
            ]);
            }
        }

        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success','Log in Successful');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Please try again'
        ]);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logout successful');
    }
    public function tologin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Generate a Sanctum token for the user
            $token = $user->createToken('POS-Access-Token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'token' => $token,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return redirect()->route('dashboard')->with('success','Log in Successful');

    }


}
