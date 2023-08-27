<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','string','min:3','max:40'],
            'phone' => ['required','string','regex:/^08/'],
            'email' => ['required','email', 'unique:users,email'],
            'password' => ['required', 'min:6','max:12'],
         ]);

       $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
     }
}
