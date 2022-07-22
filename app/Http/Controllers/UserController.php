<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $userInputs = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $userInputs['password'] = bcrypt($userInputs['password']);

        // create user and return user object
        $user = User::create($userInputs);

        // login newly created user
        auth()->login($user);

        return redirect(@route('home'))->with('message', 'User created and loggedin');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $loginFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(auth()->attempt($loginFields)) {
            $request->session()->regenerate();

            return redirect(@route('home'))->with('message', 'You are now loggin in');
        }

        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        // invalidate and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(@route('home'))->with('message', 'User successfully logged out');
    }
}
