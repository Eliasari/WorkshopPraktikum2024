<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
    public function show()
    {
        if (Auth::user()->id_jenis_user == 1) {
            $users = DB::table('user')
                ->join('jenis_user', 'user.id_jenis_user', '=', 'jenis_user.id_jenis_user')
                ->select('user.*', 'jenis_user.jenis_user')
                ->get();

            $jenis_users = DB::table('jenis_user')->get();
            return view('management.user', compact('users' , 'jenis_users'));
        } else {
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_user'      => 'required|string|max:60',
            'username'     => 'required|string|max:60',
            'password'     => 'required|string|max:60',
            'email'     => 'required|string|email|max:200|unique:user',
            'no_hp' => 'required|string|max:30',
            'wa'  => 'required|string|max:30',
            'pin' => 'required|string|max:30',
            'id_jenis_user' => 'required',
        ]);

        $user = new User;
        $user->nama_user    = $request->nama_user;
        $user->username     = $request->username;
        $user->password     = Hash::make($request->password);
        $user->email        = $request->email;
        $user->no_hp        = $request->no_hp;
        $user->wa           = $request->wa;
        $user->pin          = $request->pin;
        $user->id_jenis_user  = $request->id_jenis_user;

        $user->save();

        return redirect()->route('user.show')->with('success', 'Menu level created successfully.');
    }

    public function update(Request $request, $id_user)
    {
        $request->validate([
            'nama_user'      => 'required|string|max:60',
            'username'       => 'required|string|max:60',
            'password'       => 'nullable|string|max:60',
            'email'          => 'required|string|email|max:200|unique:user,email,' . $id_user . ',id_user',
            'no_hp'          => 'required|string|max:30',
            'wa'             => 'nullable|string|max:30',
            'pin'            => 'nullable|string|max:30',
            'id_jenis_user'  => 'required|integer',
        ]);

        $user = User::where('id_user', $id_user)->firstOrFail();

        $user->nama_user    = $request->nama_user;
        $user->username     = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->email        = $request->email;
        $user->no_hp        = $request->no_hp;
        $user->wa           = $request->wa;
        $user->pin          = $request->pin;
        $user->id_jenis_user  = $request->id_jenis_user;

        $user->save();

        return redirect()->route('user.show')->with('success', 'User updated successfully.');
    }

    public function destroy($id_user)
    {
        $user = User::where('id_user', $id_user)->first();

        if ($user) {
            $user->delete();
            return redirect()->route('user.show')->with('success', 'User deleted successfully.');
        } else {
            return redirect()->route('user.show')->with('error', 'User not found.');
        }
    }
}
