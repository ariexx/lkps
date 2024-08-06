<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public User $user)
    {
    }

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        //check in database if username and password is correct
        //if correct, redirect to dashboard
        $user = $this->user->checkLogin($username, $password);
        if ($user) {
            //put user data into session, so we can check if user is logged in or not with middleware
            $request->session()->put('user', $user);
            //redirect to dashboard
            return $user->redirectDashboard();
        }

        //if not, redirect back to login page with error message
        return redirect('/login')->withErrors(['password' => 'Username atau password salah']);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        //validate using RegisterRequest
        $request->validated();

        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->password = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $user->save();

        return redirect('/login')->with('success', 'Registrasi berhasil, silahkan login');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect('/login');
    }
}
