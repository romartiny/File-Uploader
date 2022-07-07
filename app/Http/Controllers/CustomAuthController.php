<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Rules\IsValidPassword;
use App\Models\Attempts;

class CustomAuthController extends Controller
{
    public function login()
    {
        return view('index');
    }

    public function registration()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'confirm_email' => 'required|same:email',
            'password' => ['required', 'min:6', 'max:36', new isValidPassword()],
            'confirm_password' => 'required|same:password'
        ]);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();
        if ($res) {
            $request->session()->put('loginId', $user->id);
            return redirect('dashboard');
        } else {
            return back()->with('fail', 'Something was wrong');
        }
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:36',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        Attempts::deleteUsersAttempts();
        if (Attempts::findIpAttempts($this->getUserIp()) >= 3) {
            return back()->with('fail', 'Attempts count reach. 5 minute ban.');
        } else {
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('dashboard');
                } else {
                    Attempts::addIpAttempts($this->getUserIp(), $request->email);
                    return back()->with('fail', 'Password not matches');
                }
            } else {
                Attempts::addIpAttempts($this->getUserIp(), $request->email);
                return back()->with('fail', 'This email if not registered');
            }
        }

    }

    public function showDashboard()
    {
        $data = [];
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('upload', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('/login');
        }
        return redirect('/login');
    }

    public function getUserIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
