<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:partner')->except('logout');
    }

    protected function validator(Request $request)
    {
        return $this->validate($request, [
            'email'   => 'required|email|email:rfc,dns',
            'password' => 'required|min:8'
        ]);
    }

    protected function guardLogin(Request $request, $guard)
    {
        $this->validator($request);

        return Auth::guard($guard)->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        );
    }

    /*Admin Login*/
    public function showAdminLoginForm()
    {
        return view('admin.login', [
            'url' => Config::get('constants.guards.admin')
        ]);
    }

    public function adminLogin(Request $request)
    {
        if ($this->guardLogin($request, Config::get('constants.guards.admin'))) {
            return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
    /*Partner Login*/
    public function showPartnerLoginForm()
    {
        return view('auth.login', [
            'url' => Config::get('constants.guards.partner')
        ]);
    }

    public function partnerLogin(Request $request)
    {
        if ($this->guardLogin($request,Config::get('constants.guards.partner'))) {
            return redirect()->intended('/home');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}
