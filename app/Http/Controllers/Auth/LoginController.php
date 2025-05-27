<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Validateor;
use Illuminate\Support\Facades\Session;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
  
    protected function redirectTo()
    {
       
        $role_id = Auth::user()->role_id;
        if($role_id == 1){
            return '/admin/home';
        }elseif($role_id == 2 ){
            return '/dashboard';    
        }else{
            return '/home';    
        }  
    }

    protected function authenticated(Request $request, $user)
    {
        Session::forget('url.intended'); // Clear the intended URL
        
        // Redirect based on user role
        if (Auth::user()->role_id === 1) {
            return redirect()->route('admin.home');
        } elseif ( Auth::user()->role_id === 2) {
            return redirect()->route('dashboard');
        }elseif ( Auth::user()->role_id === 3) {
            return redirect()->route('agent.home');
        }
        
        return redirect('/');
    }
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
     public function logout(Request $request) {
       
      Auth::logout();
      return redirect('/');
    }
}
