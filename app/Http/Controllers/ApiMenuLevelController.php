<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuLevel;
use Illuminate\Support\Facades\Auth;

class ApiMenuLevelController extends Controller
{

    public function showMenuLevel()
    {
        $menu_level = MenuLevel::all();

        return response()->json([
            'status' => 'success',
            'data' => $menu_level
        ], 200);
    }


       public function store(Request $request)
       {
           $request->validate([
               'id_level' => 'required',
               'level' => 'required|string|max:60',
               'create_by' => 'required|string|max:60',
           ]);

           $menu_level = MenuLevel::create($request->all());
           return response()->json([
               'status' => 'success',
               'message' => 'Menu level created successfully',
               'menu_level' => $menu_level
           ], 201);
       }

       public function update(Request $request, $id)
       {
           $request->validate([
               'level' => 'required|string|max:60',
               'create_by' => 'required|string|max:60',
           ]);

           $menu_level = MenuLevel::findOrFail($id);
           $menu_level->level = $request->input('level');
           $menu_level->create_by = $request->input('create_by');
           $menu_level->save();

           return response()->json([
               'status' => 'success',
               'message' => 'Menu level updated successfully',
               'menu_level' => $menu_level
           ], 200);
       }


       // Menghapus MenuLevel berdasarkan ID (DELETE /menuLevel/{id})
       public function destroy($id)
       {
           $menu_level = MenuLevel::findOrFail($id);
           $menu_level->delete();

           return response()->json([
               'status' => 'success',
               'message' => 'Menu level deleted successfully'
           ], 200);
       }
}
