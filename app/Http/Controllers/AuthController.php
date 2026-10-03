<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        $errors = session('errors');
        $notificationType = session('login_notification_type', 'default');
        $notificationMessage = session('login_notification_message', 'Welcome to ParkFlow! 🚗 Please enter your login details.');
        if ($errors && $errors->any()) {
            $notificationType = 'error';
            $notificationMessage = $errors->first();
        }
        return view('parkflow.auth.login', compact('notificationType', 'notificationMessage'));
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);
        $remember = $request->boolean('remember');
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
            ])
            ->log('User logged in');
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Welcome back to ParkFlow.');
        }

        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => 'The email or password you entered is incorrect.'])
            ->with('login_notification_type', 'error')
            ->with('login_notification_message', 'Your email or password does not match. Please try again.');
    }
    public function checkEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);
        $exists = User::where('email', $validated['email'])->exists();
        return response()->json([
            'verified' => $exists,
            'message' => $exists ? 'Email registered successfully.' : 'Email address not found.',
        ]);
    }
    public function checkPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);
        $user = User::where('email', $validated['email'])->first();
        $verified = $user && Hash::check($validated['password'], $user->password);
        return response()->json([
            'verified' => $verified,
            'message' => $verified ? 'Password verified successfully.' : 'The email or password is incorrect.',
        ]);
    }
    public function logout(Request $request)
    {
        activity()
            ->causedBy(Auth::user())
            ->withProperties([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ])
            ->log('User logged out');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }
}
