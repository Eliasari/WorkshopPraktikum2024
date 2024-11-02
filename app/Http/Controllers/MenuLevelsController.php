<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MenuLevel;

class MenuLevelsController extends Controller
{
    public function index()
    {
        if (Auth::user()->id_jenis_user == 1) {
            $menu_level = MenuLevel::all();
            return view('management.menulevel', compact('menu_level'));
        } else {
            return redirect()->route('home');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_level' => 'required',
            'level' => 'required|string|max:60',
            'create_by' => 'required|string|max:60',
        ]);

        MenuLevel::create($request->all());

        return redirect()->route('menuLevels.show')->with('success', 'Menu level created successfully.');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'level' => 'required|string|max:60',
            'create_by' => 'required|string|max:60',
        ]);

        $menu_level = MenuLevel::findOrFail($id);
        $menu_level->update($request->all());

        return redirect()->route('menuLevels.show')->with('success', 'Menu level updated successfully.');
    }

    public function destroy($id)
    {
        $menu_level = MenuLevel::findOrFail($id);
        $menu_level->delete();

        return redirect()->route('menuLevels.show')->with('success', 'Menu level deleted successfully.');
    }
}
