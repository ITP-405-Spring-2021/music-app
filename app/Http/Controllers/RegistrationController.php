<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password')); // bcrypt
        $user->role()->associate(
            // Role::where('slug', '=', 'user')->first()
            Role::getUser()
        );
        $user->save();

        Auth::login($user);
        return redirect()->route('profile.index');
    }
}
