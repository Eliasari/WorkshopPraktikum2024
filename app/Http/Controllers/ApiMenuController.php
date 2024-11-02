<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\MenuLevel;

class ApiMenuController extends Controller
{
    public function index()
    {
        $data = Menu::all();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function ambilMenuLevel()
    {
        $menu_level = MenuLevel::all();
        return response()->json([
            'status' => 'success',
            'data' => $menu_level
        ], 200);
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        $menu_level = MenuLevel::all();

        if ($menu) {
            return response()->json([
                'status' => 'success',
                'data' => $menu,
                'kategori' => $menu_level
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    // Menambahkan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'create_id_level' => 'required|exists:menu_level,id_level',
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_icon' => 'required',
            'create_by' => 'required',
        ]);

        $menu = Menu::create([
            'menu_id' => $request->menu_id,
            'id_level' => $request->create_id_level,
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_icon' => $request->menu_icon,
            'create_by' => $request->create_by,
            // 'create_by' =>
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu created successfully.',
            'menu' => $menu
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_level' => 'required|exists:menu_level,id_level',
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_icon' => 'required',
            'create_by' => 'required',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Menu updated successfully.',
            'menu' => $menu
        ], 200);
    }


    // Menghapus menu
    public function destroy($id)
    {
        Menu::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu deleted successfully.'
        ], 200);
    }
}
