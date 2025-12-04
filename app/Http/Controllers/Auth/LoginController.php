<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        $this->middleware('auth')->only('logout');
    }

    /**
     * After the user is authenticated, redirect them according to role.
     * Respects the intended URL (redirect()->intended).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function authenticated(Request $request, $user)
    {
        // Prefer intended URL if present, otherwise use role-based route
        if ($request->session()->has('url.intended')) {
            return redirect()->intended();
        }

        if (isset($user->role)) {
            $role = strtolower($user->role);
            if ($role === 'emprendedor') {
                return redirect()->route('emprendedor.dashboard');
            }
            if ($role === 'donante') {
                return redirect()->route('donante.donaciones.index');
            }
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        }

        // Fallback to default home
        return redirect()->route('home');
    }
}
