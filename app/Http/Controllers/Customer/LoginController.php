<?php

namespace App\Http\Controllers\Customer;

use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    //use Socialite;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('customer.auth.login');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->guard()->attempt($this->credentials($request), $request->remember)) {

            return $request->has('previous') ? Redirect::to($request->previous) : redirect(route('customer'));
        } else {
            return redirect()->back()->with('status', 'Email Or Password Not match!')->withInput($request->only('email', 'remember'));
        }
    }

    /**
     * @param $request
     */
    protected function validateLogin($request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);
    }

    /**
     * @param $request
     * @return array
     */
    protected function credentials($request)
    {
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
        $this->guard()->logout();
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

    public function guard()
    {
        return Auth::guard('customer');
    }
}
