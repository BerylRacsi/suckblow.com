<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\User;
use App\Admin;
use App\Partner;
use File;
use Image;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:partner');
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register-admin');
    }

    public function showPartnerRegisterForm()
    {
        return view('auth.register-partner');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email' => 'email:rfc,dns', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','string', 'min:8','max:15'],
            'address' => ['required','string', 'max:100'],
            'nationality' => ['required'],

            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
    }

    protected function validatorAdmin(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email' => 'email:rfc,dns', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function validatorPartner(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email' => 'email:rfc,dns', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required','string', 'min:8','max:15'],
            'address' => ['required','string', 'max:100'],
            'category' => ['required'],
            'country' => ['required'],
            'province' => ['required','string','max:25'],
            'city' => ['required','string','max:25'],

            'image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();
        $this->validator($request->all())->validate();

        if ($request->hasFile('image')) {
            $avatar = $request->file('image');

            $dir_img = true;

            if( ! File::exists('images/user_avatar/')) {
                $dir_img = File::makeDirectory('images/user_avatar/', 0777, true);
            }

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/user_avatar/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'nationality' => $data['nationality'],
            'image'  => $image_path,
        ]);
    }

    protected function createAdmin(Request $request)
    {
        $this->validatorAdmin($request->all())->validate();
        Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    protected function createPartner(Request $request)
    {
        $this->validatorPartner($request->all())->validate();

        if ($request->hasFile('image')) {
            $avatar = $request->file('image');

            $dir_img = true;

            if( ! File::exists('images/partner_avatar/')) {
                $dir_img = File::makeDirectory('images/partner_avatar/', 0777, true);
            }

            $filename = rand(1111,9999).time().'.'.$avatar->getClientOriginalExtension();
            $image_path = 'images/partner_avatar/'.$filename;

            Image::make($avatar)
                ->fit(640,640,function($constraint){
                    $constraint->upsize();
                })
                ->save($image_path);
        }

        Partner::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone' => $request['phone'],
            'address' => $request['address'],
            'category' => $request['category'],
            'country' => $request['country'],
            'province' => $request['province'],
            'city' => $request['city'],
            'image'  => $image_path,
        ]);
        return redirect()->intended('login/partner');
    }
}
