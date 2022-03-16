<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PatientInformation;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    { 
        
       
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before:13 years ago'],
            'contact_number' => ['required', 'regex:/^\+?[0-9]{10,13}$/', 'unique:patient_information'],
            'sex'=>['required'],
            'purok'=>['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'min:6', 'regex:/^[a-zA-Z0-9]+$/'],
            'email' => ['max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $name= $request->first_name;
        if($request->middle_name != ""){
            $name.=' '.$request->middle_name;
        }
        $name.=' '.$request->last_name;
        if($request->suffix != ""){
            $name.=' '.$request->suffix;
        }

        $user = User::create([
            'name' => $name,
            'user_type_id' => 2,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $patient = PatientInformation::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
            'sex'=>$request->sex,
            'contact_number'=>$request->contact_number,
            'contact_number_verified'=>Hash::make($user->id.'NO'),
            'purok_id'=>$request->purok,
            'birthdate' => $request->birthdate,
            ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
