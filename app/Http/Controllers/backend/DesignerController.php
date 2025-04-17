<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignerController extends Controller
{
    public function newDesigner(){
        return view('backend.pages.designers.new_designer');
    }
    public function storeDesigner(Request $request)
        {
            return response()->json(request()->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:designers,email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'status' => 'required|in:active,inactive',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            DB::beginTransaction();

            try {
                $imageName = null;

                if ($request->hasFile('image')) {
                    $imageName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('images/designers'), $imageName);
                }

                Designer::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'bio' => $request->bio,
                    'status' => $request->status,
                    'image' => $imageName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::commit();

                return response()->json(['success' => true, 'message' => 'Designer added successfully!']);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    public function viewDesigners(){
            $designers = Designer::all();
            return view('backend.pages.designers.fetch_designer', compact('designers'));
        }
}
