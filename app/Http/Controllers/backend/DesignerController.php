<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DesignerController extends Controller
{
    public function newDesigner(){
        return view('backend.pages.designers.new_designer');
    }
    public function storeDesigner(Request $request)
        {
            // return response()->json($request->all());
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
                    'status' => (int)$request->status,
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

        public function updateDesigner(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'address' => 'required|string|max:255',
                'bio' => 'required|string',
                'status' => 'required|in:active,inactive',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $designer = Designer::find($request->id);

            if (!$designer) {
                return response()->json(['status' => 'error', 'message' => 'Designer not found']);
            }

            // Delete old image before uploading new one
            if ($request->hasFile('image')) {
                $oldImagePath = public_path('images/designers/' . $designer->image);
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/designers'), $imageName);
                $designer->image = $imageName;
            }

            // Update other fields
            $designer->name = $request->name;
            $designer->email = $request->email;
            $designer->phone = $request->phone;
            $designer->address = $request->address;
            $designer->bio = $request->bio;
            $designer->status = $request->status === 'active' ? 1 : 0;

            $designer->save();

            return response()->json(['status' => 'success', 'designer' => $designer]);
        }


     public function delete($id)
        {
            try {
            $designer = Designer::findOrFail($id);
            // return $designer;
        
            $imagePath = public_path('images/designers/' . $designer->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            
            if ($designer->delete()) {
                return back()->with(['status' => 'Data Deleted Successfully']);
            }
            } catch (\Throwable $th) {
                return $th;
            }
            

            
        }

}
