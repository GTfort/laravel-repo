<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
    public function showCorrectHomepage()
    {

        if (Auth::check()) {
            return view('homepage-feed');
        } else {
            return view('homepage');
        }
    }
    //
    function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:255', 'confirmed']
        ]);
        $user = User::create([
            'username' => $incomingFields['username'],
            'email' => $incomingFields['email'],
            'password' => bcrypt($incomingFields['password'])
        ]);
        Auth::login($user);
        return redirect('/')->with('success', 'Your account has been created and you can now log in!');
    }

    function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => ['required'],
            'loginpassword' => ['required']
        ]);
        if (Auth::attempt([
            'username' => $incomingFields['loginusername'],
            'password' => $incomingFields['loginpassword']
        ])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in!');
        } else {
            return redirect('/')->with('failure', 'Invalid username/password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function profile($user)
    {
        $user = User::where('username', $user)->first();
        return view('profile-post', ['username' => $user->username, 'posts' => $user->posts()->latest()->get(), 'postCount' => $user->posts()->count()]);
    }
    public function showAvatarForm()
    {
        return view('manage-avatar');
    }
    public function storeAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:5000'
        ]);
        $uniqueFilename = Auth::user()->id . '-' . uniqid() . '.jpg';

        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('avatar'));
        $imageData = $image->cover(120, 120)->toJpeg();
        Storage::disk('public')->put('avatars/' . $uniqueFilename, $imageData);

        $user = Auth::user();
        $user->avatar = $uniqueFilename;

        // $user->save();
        // return redirect('/profile/' . $user->username)->with('success', 'Avatar successfully updated.');
        return 'Saved';
    }
}
