<?php

namespace App\Http\Controllers\Admin\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'Admin Login',
            'loginRoute' => 'admin.login',
            'forgotPasswordRoute' => 'admin.password.request',
        ]);
    }

    /**
     * Login the admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //Validation...
        $this->validator($request);
        //Login the admin...
        if(Auth::guard('admin')->attemp($request->only('email','password'),$request->filled('remember'))){
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are logged in as Admin!');
        }

        //Redirect the admin...
        return $this->loginFailed();
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
      //logout the admin...
    }

    /**
     * Validate the form data.
     *
     * @param \Illuminate\Http\Request $request
     * @return
     */
    private function validator(Request $request)
    {
      //Validations rules
      $rules = [
          'email' => 'required|email|exists:admins|min:5|max:191',
          'password' => 'required|string|min:4|max:255'
      ];

      $messages = [
          'email.exists' => 'These credentials do not match our records.'
      ];

      $request->validate($rules,$messages);
    }

    /**
     * Redirect back after a failed login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
      //Login failed...
      return redirect()
        ->back()
        ->withInput()
        ->with('error','Login failed, please try again!');
    }
}
