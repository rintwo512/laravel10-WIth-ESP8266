<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login', [
            'title' => 'Sign In'
        ]);
    }


    public function postLogin(Request $request)
    {
        $validate = $request->validate([
            'nik' => 'required|numeric',
            'password' => 'required'
        ]);

        $nik = $request->nik;

        $users = User::where('nik', $nik)->get()->toArray();


        // if ($users[0]['status_login'] == 'online') {
        //     return back()->with('loginError', 'User is online!');
        // }

        if ($users) {

            if ($users[0]['is_active'] == 1) {

                $sess = User::find($users[0]['id'])->userAgent;

                $id = $users[0]['id'];

                if (Auth::attempt($validate)) {

                    $user = User::find($id);
                    $user->userAgent->lat = $request->lat;
                    $user->userAgent->long = $request->long;
                    $user->userAgent->user_agent = $request->userAgent();
                    $user->push();

                    User::where('id', Auth::user()->id)->update(['user_time_login' => Carbon::now()]);

                    $request->session()->regenerate();



                    // Cek role pengguna dan arahkan ke URL yang sesuai
                    if ($users[0]['role'] == 1) {
                        return redirect()->intended('/home');
                    } else if ($users[0]['role'] == 0) {
                        return redirect()->intended('/ac');
                    }
                }
            } else {

                return back()->with('loginError', 'Sorry,' . ' ' . '<span style="color:red">' . $users[0]['name'] . '</span>' . ' ' . 'your account is not active!');
            }
        } else {

            return back()->with('loginError', 'This' . ' ' . '<span style="color:red">' . $request->nik . '</span>' . ' ' . 'is not registered yet!');
        }

        return back()->with('loginError', 'Wrong NIK or Password!');
    }

    public function logout(Request $request, $id)
    {

        $log = User::find($id);

        $data = ['status_login' => 'offline'];

        $log->where('id', $id)->update($data);

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth');
    }
}
