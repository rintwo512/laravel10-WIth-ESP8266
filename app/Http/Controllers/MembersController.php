<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MSession;


class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('members.index', [
            'title' => 'Data Users',
            'dataUsers' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'nik' => 'required|numeric|unique:users',
            'password' => 'required|min:3'
        ]);

        if ($request->isActive > 0) {

            $validateData['is_active'] = $request->isActive;
        } else {

            $validateData['is_active'] = 0;
        }
        if ($request->role > 0) {
            $validateData['role'] = $request->role;
        } else {
            $validateData['role'] = 0;
        }


        $validateData['image'] = 'default.png';
        $validateData['password'] = bcrypt($request->password);

        User::create($validateData);
        return redirect('/members');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->isActive > 0 || $request->role > 0) {
            $data['is_active'] = $request->isActive;
            $data['role'] = $request->role;
        } else {
            $data['is_active'] = 0;
            $data['role'] = 0;
        }

        if (MSession::where('user_id', $id)->count() == 0) {
            MSession::create([
                'user_id' => $id
            ]);
        }

        User::where('id', $id)->update($data);
        return redirect('/members');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        MSession::where('user_id', $id)->delete();

        return response()->json(['success', 'User has been delete!']);
    }
}
