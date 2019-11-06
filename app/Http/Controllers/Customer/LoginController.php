<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    //use Socialite;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm(){
        return view('customer.auth.login');
    }

    /**
     * CustomerLoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest:customer')->except('logout','customerLogout');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::guard('customer')->attempt($this->credentials($request), $request->remember)){
            if ($request->has('previous')) {
                return Redirect::to($request->previous);
            }
            else{
                return redirect()->route('customer');
            }
        }
        else{
            return redirect()->back()->with('status', 'Email Or Password Not match!')->withInput($request->only('email','remember'));
        }

    }

    /**
     * @param $request
     */
    protected function validateLogin($request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
    }

    /**
     * @param $request
     * @return array
     */
    protected function credentials($request){
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function customerLogout(Request $request)
    {
        Auth::guard('customer')->logout();
        /*$request->session()->invalidate();*/
        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }




    //socialite login


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $customer = Socialite::driver('facebook')->user();

        // $user->token;
    }
}
