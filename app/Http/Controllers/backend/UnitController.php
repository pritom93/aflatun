<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Unit;
use Illuminate\Support\Str;

class UnitController extends Controller
{
    public function newUnit()
    {
        return view('backend.pages.unit.new_unit');
    }
    public function createUnit(Request $request)
    {
        $formData = $request->all();

        Unit::create([
            'unit_name' => $formData['name'],
            'slug' => str::slug($formData['name']),
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Unit created successfully!'
        ]);
    }
    public function unitView()
    {
        $unit_data = Unit::get();
        return view('backend.pages.unit.unit_view', ['units' => $unit_data]);
    }
    public function unitIdDelete($id)
    {
        $unit_id = Unit::find($id);
        $unit_id->delete();
        return redirect('admins/unit_view');
    }
    public function unitIdUpdate($id)
    {
        $unit_data = Unit::where('id', $id)->first();
        return view('backend.pages.unit.edit_unit', ['units' => $unit_data]);
    }
    public function updateUnit(Request $request)
    {
        $id = $request->id;
        $units = Unit::find($id);
        $units->update([
            'unit_name' => $request->name,
        ]);
        return response()->json('Updated');
    }
}
