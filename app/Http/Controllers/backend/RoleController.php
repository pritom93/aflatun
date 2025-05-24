<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
   public function roleIndex(){
    return view('backend.pages.admin.role.new_role');
   }

   public function roleInsert(Request $request){

    // return response()->json($request->permission);

    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:active,inactive',
        'permission' => 'required',
    ]);

    $statusValue = $request->status === 'active' ? 1 : 0;
    
    $role = Role::create([
        'name' => $request->name,
        'status' => $statusValue,
        'permission' => $request->permission,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Role inserted successfully!',
        'data' => $role,
    ]);

   }
   public function roleView(){
    $role = Role::all();
    return view('backend.pages.admin.role.view_role',['roles' => $role]);
   }

   public function edit($id)
    {
        $role = Role::find($id);
        if ($role) {
            return response()->json($role);
        } else {
            return response()->json(['error' => 'Role not found'], 404);
        }
    }

    public function update(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $role->name = $request->name;
        $role->status = $request->status;
        $role->permission = $request->permission;
        $role->save();

        return response()->json(['success' => true]);
    }
    public function destroy(Request $request)
    {
        $role = Role::findOrFail($request->id);
        $role->delete();

        return response()->json(['success' => true]);
    }

}
