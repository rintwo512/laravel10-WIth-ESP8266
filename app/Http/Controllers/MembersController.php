<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2',
            'nik' => 'required|digits:8|numeric|unique:users',
            'password' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return redirect('/members')
                ->withErrors($validator)
                ->withInput();
                // ->with('error', $request->name . ' gagal ditambahkan!');
        }

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
        $validateData['name'] = $request->name;
        $validateData['nik'] = $request->nik;

        User::create($validateData);
        return redirect('/members')->with('success', $request->name . ' berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function detailUser($id)
    {
        $userDetails = User::find($id);
        return view('members.detailUser', [
            'title' => 'Data Detail User',
            'data' => $userDetails
        ]);
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
        return redirect('/members')->with('success', 'Data user berhasil diupdate!' );
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
