<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //Show the registration form
    public function create()
    {
        return view('register');
    }

    //Register a new user
    public function store(Request $request)
    {
        //Validate the form
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        //Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Log in the registered user
        auth()->login($user);

        return redirect()->route('products.index');
    }
}
