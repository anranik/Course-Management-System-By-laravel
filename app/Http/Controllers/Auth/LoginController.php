<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    //protected $redirectTo = '/admin/home';
    protected function authenticated($request, $user)
    {

        if($user->hasRole('administrator')){
            return redirect('/admin/home');
        }elseif($user->hasRole('Director')){
            return redirect('admin/director/dashboard');
        }elseif($user->hasRole('Instructor')){
            return redirect('admin/instructor/dashboard');
        }elseif($user->hasRole('Course Builder')){
            return redirect('admin/course_builder/dashboard');
        }else{
            return redirect('admin/instructor/dashboard');
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    
}
