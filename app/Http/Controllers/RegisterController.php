<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function storeUser(Request $request)
    {
        $request->validate([
            'nama_user'  => 'required|string|max:60',
            'username'  => 'required|string|max:60',
            'email'     => 'required|string|email|max:200|unique:users',
            'password'  => 'required|string|max:60',
        ]);

        DB::table('user')->insert([
            'nama_user'  => $request->nama_user,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'id_jenis_user' => 3,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        return redirect('login')->withSuccess('User successfully registered.');
    }
}
