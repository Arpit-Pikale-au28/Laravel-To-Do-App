<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->withErrors(['msg' => 'You Have Been Logout.']);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email'     => 'required|email',
                'password'  => 'required|min:8'
            ]
        );

        if ($validator->fails()) {
            return redirect('login')->withErrors($validator);
        }

        $userData = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($userData)) {
            return redirect('login')->withErrors(['isValid' => 'Invalid Credentils try again !!']);
        }

        $request->session()->regenerate();
        // $request->session()->put('user', Auth::user());
        return redirect()->route('dashboard');
    }

    public function register(Request $request)
    {
        $rules = [
            'fname'     => ['required', 'string'],
            'lname'     => ['required', 'string'],
            'mobile'    => ['required', 'string'],
            'address'   => ['string'],
            'email'     => ['required', 'email'],
            'password'  => ['required', 'min:8'],
            'cpassword' => ['required', 'same:password'],
        ];

        $messages = [
            'fname.required'      => 'First name is required.',
            'lname.required'      => 'Last name is required.',
            'mobile.required'     => 'Please enter your mobile number.',
            'email.required'      => 'We need an email address to contact you.',
            'email.email'         => 'That doesn’t look like a valid email format.',
            'password.required'   => 'Choose a password.',
            'cpassword.required'  => 'Please confirm your password.',
            'cpassword.same'      => 'Password and confirmation must match.',
        ];

        $attributes = [                       // optional: prettier field names
            'fname'     => 'first name',
            'lname'     => 'last name',
            'mobile'    => 'mobile number',
            'cpassword' => 'confirm password',
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            $messages,      // custom messages
            $attributes     // custom attribute names
        );

        if ($validator->fails()) {
            return redirect('register')->withErrors($validator);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect('register')->withErrors(['userExists' => 'User Alredy Exists !!']);
        }

        $user = User::create([
            'first_name'  => $request->fname,
            'last_name'   => $request->lname,
            'mobile_no'   => $request->mobile,
            'address'     => $request->address,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
        ]);
        $user->save();

        return redirect('dashboard')->withErrors(['successMessage' => 'User Registered Successfully !!']);
    }

    public function dashboardView()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }
}
