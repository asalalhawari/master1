<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    // Show the registration form
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);
    
        // Create the user and hash the password
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    
        // Fire the Registered event
        event(new Registered($user));
    
        // Send the email verification link
        $user->sendEmailVerificationNotification();
    
        // Log the user in after registration, to avoid them getting redirected to login
        auth()->login($user);
    
        // Redirect to the verification page
        return redirect()->route('verification.notice')->with('status', 'We have emailed your verification link!');
    }
}
