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
        toastr()->success('You Have Been Logout.');
        return redirect('login');
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
            foreach($validator->errors()->all() as $errors) {
                toastr()->error($errors);
            }
            return redirect()->back();
        }

        $userData = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($userData)) {
            toastr()->error('Invalid Credentils try again !!');
            return redirect()->back();
        }

        $request->session()->regenerate();
        $userName = Auth::user()->first_name;
        toastr()->success("Welcome {$userName}");
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
            foreach($validator->errors()->all() as $errors) {
                toastr()->error($errors);
            }
            return redirect()->back();
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            toastr()->error('User Alredy Exists !!');
            return redirect()->back();
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
        toastr()->success('User Registered Successfully !!');
        return redirect('login');
    }

    public function dashboardView()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }
}
