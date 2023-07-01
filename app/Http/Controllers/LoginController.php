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
                    // User::where('id', Auth::user()->id)->update(['status_login' => 'online']);

                    // $userLogin = User::where('status_login', 'online')->first();
                    // $pesan = $userLogin->name . " " . $userLogin->status_login . " " . Carbon::parse($userLogin->user_time_login)->diffForHumans();
                    // $pesanEncode = urlencode($pesan);
                    // echo Http::get('https://api.telegram.org/bot5372613320:AAHJNa6n0C68VZFWIDcRckIWSjP_UCLiGBU/sendMessage?parse_mode=markdown&chat_id=-532291265&text=' . $pesanEncode);



                    $request->session()->regenerate();


                    return redirect()->intended('/home');
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
