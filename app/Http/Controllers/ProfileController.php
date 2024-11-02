<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $userId = Auth::id();
        $user = DB::table('user')
            ->join('jenis_user', 'user.id_jenis_user', '=', 'jenis_user.id_jenis_user')
            ->where('user.id_user', $userId)
            ->select('user.*', 'jenis_user.jenis_user', 'user.nama_user')
            ->first();

        return view('management.profile', compact('user'));
    }


    // public function showProfile()
    // {
    //     $user = Auth::user();
    //     return view('management.profile', compact('user'));
    // }


    public function updateBiodata(Request $request)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:60,',
            'username' => 'required|string|max:60|unique:user,username,' . $userId . ',id_user',
            'password' => 'nullable|string|max:60',
            'email' => 'required|string|email|max:200|unique:user,email,' . $userId . ',id_user',
            'no_hp' => 'required|string|max:30',
            'wa' => 'nullable|string|max:30',
        ]);

        $user = User::findOrFail($userId);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->nama_user = $validatedData['nama_user'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->no_hp = $validatedData['no_hp'];
        $user->wa = $validatedData['wa'];

        $user->save();

        return redirect()->route('profile.show')->with('success', 'User updated successfully.');
    }

}
