<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function ambilData()
    {
        $data = user::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function ambilJenisUser(){
        $data = JenisUser::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        $jenisUsers = JenisUser::all();

        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user,
                'jenisUsers' => $jenisUsers
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    //create
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_user'      => 'required|string|max:60',
            'username'     => 'required|string|max:60',
            'password'     => 'required|string|max:60',
            'email'     => 'required|string|email|max:200|unique:user',
            'no_hp' => 'required|string|max:30',
            'wa'  => 'required|string|max:30',
            'pin' => 'required|string|max:30',
            'create_jenis_user' => 'required',
        ]);

        $user = new User;
        $user->nama_user    = $request->nama_user;
        $user->username     = $request->username;
        $user->password     = Hash::make($request->password);
        $user->email        = $request->email;
        $user->no_hp        = $request->no_hp;
        $user->wa           = $request->wa;
        $user->pin          = $request->pin;
        $user->id_jenis_user  = $request->create_jenis_user;

        $user->save();

        return response()->json(['status' => 'success'], 200);
    }


    // Update user
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->nama_user = $request->nama_user;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->wa = $request->wa;
            $user->pin = $request->pin;
            $user->id_jenis_user = $request->id_jenis_user;
            $user->save();

            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    // Method untuk menghapus data user (DELETE)
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }
}
