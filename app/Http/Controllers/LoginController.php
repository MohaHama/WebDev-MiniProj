<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Show the login form
    public function create()
    {
        return view('login');
    }

    //Log in the user
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($credentials)) {
            return redirect()->route('products.index');
        }

        //Return to login with an error message
        return back()->withErrors([
            'email' => 'Invalid email or password.'
        ]);
    }

    //Log out the user
    public function destroy()
    {
        auth()->logout();

        return redirect()->route('products.index');
    }
}
