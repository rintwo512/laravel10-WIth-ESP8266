<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('userSetting.settingProfile', [
            'title' => 'User Profile'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('userSetting.changepassword', [
            'title' => 'Change Password'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ddd('dfgdgfd');
    }

    /**
     * Display the specified resource.
     */
    public function updatePass(Request $request, $id)
    {

        $userSet = User::where('id', $id)->first();

        $rules = [
            'changeOldPass' => 'required',
            'password' => 'required|min:4|confirmed'
        ];
        $oldPass = $request->changeOldPass;
        $newPass = $request->password;
        // dd($oldPass);

        if (!Hash::check($oldPass, $userSet->password)) {
            return back()->with('alert', 'password anda salah!');
        } else {
            if (Hash::check($newPass, $userSet->password)) {
                return back()->with('alert', 'password baru tidak boleh sama dengan password lama!');
            } else {

                $request->validate($rules);
                $data['password'] = bcrypt($request->password);


                User::where('id', $id)->update($data);
                return back()->with('success', 'Password berhasil diubah!');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        ddd('fsdfsdfds');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
            'image' => 'image|file|max:1024'
        ];




        $validateData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImg) {
                Storage::delete($request->oldImg);
            }
            $validateData['image'] = $request->file('image')->store('user-images');
        }

        User::where('id', $id)
            ->update($validateData);

        return back()->with('success', 'Profile updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
