<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255', 'confirmed']
        ]);
        User::create([
            'username' => $incomingFields['username'],
            'email' => $incomingFields['email'],
            'password' => bcrypt($incomingFields['password'])
        ]);
        return 'this is the register page';
    }
}
