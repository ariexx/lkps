<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
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

        if(Auth::attempt(['username' => $username, 'password' => $password])) {
            $request->session()->regenerate();
            $user = $this->user->where('username', $username)->first();
            $request->session()->put('user', $user);

            return $this->user->redirectDashboard();
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
       Auth::logout();

         $request->session()->invalidate();

         $request->session()->regenerateToken();

        return redirect('/login');
    }
}
