<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    public function redirectTo(){
        if(Auth::user()->role == "user"){
            Session::flash('success', "You are now registered");

            return $this->redirectTo = '/userDashboard'; 
        }
        else if(Auth::user()->role == "admin"){
            Session::flash('success', "You are now registered");

            return $this->redirectTo = '/adminDashboard';
        }
        else{
            return $this->redirectTo = '/login';
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $slug = Str::slug($data['name']);
        $data['name_slug'] = $slug;
        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3','max:255', 'unique:users,name','regex:/^[a-zA-Z\s]+$/'],
            'name_slug' => ['unique:users,name_slug'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required','string','min:8','max:40'],
            'dob' => ['required','date_format:Y-m-d','before:'.date('2012-01-01')],
            'phone_number' => ['required','regex:/^[0-9]+$/','min:10','max:10']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $slug = Str::slug($data['name']);
        
        return User::create([
            'name' => $data['name'],
            'name_slug' => $slug,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'dob' => $data['dob'],
            'phone_number' => $data['phone_number'],
            'role' => 'user',
            'profile_image' => 'no_image.jpg'
        ]);
    }

    
}
