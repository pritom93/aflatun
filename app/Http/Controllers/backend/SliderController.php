<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index(){
        return view('backend.pages.sliders.new_slider');
    }


    public function store(Request $request)
    {
        // return response()->json($request->all());
    $request->validate([
        'title' => 'nullable|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:8048', // max 2MB
        'button_text' => 'nullable|string|max:255',
        'button_link' => 'nullable|string|max:255',
        'page' => 'nullable|integer',
        'precedence' => 'nullable|integer',
        'is_active' => 'required|boolean',
        'starts_at' => 'nullable|date',
        'ends_at' => 'nullable|date',
        'image_link' => 'nullable|string|max:255',
    ]);
    // return response()->json($val);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $extension = $request->file('image')->getClientOriginalExtension();
        $image_name = date('Y-m-d') . uniqid() . time() . '.' . $extension;
        $request['image']->move(public_path('images/sliders'), $image_name);
    }
    $slider = Banner::create([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'image' => $image_name,
        'image_url' => $request->image_link,
        'button_text' => $request->button_text,
        'button_link' => $request->button_link,
        'page' => $request->page ?? 0,
        'precedence' => $request->precedence ?? 0,
        'is_active' => $request->is_active,
        'starts_at' => $request->starts_at,
        'ends_at' => $request->ends_at,
    ]);

    return response()->json(['message' => 'Slider created successfully', 'data' => $slider]);
    }

    public function viewSlider()
        {
            $sliders = Slider::all();
            return view('backend.pages.sliders.fetch_slider', compact('sliders'));
        }

        // Update slider info
        public function updateSlider(Request $request)
        {
            $request->validate([
                'id' => 'required|exists:sliders,id',
                'title' => 'nullable|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:8048',
                'image_url' => 'nullable|string|max:255',
                'button_text' => 'nullable|string|max:255',
                'button_link' => 'nullable|string|max:255',
                'page' => 'nullable|integer',
                'precedence' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
                'starts_at' => 'nullable|date',
                'ends_at' => 'nullable|date',
            ]);

            $slider = Slider::findOrFail($request->id);

            // Handle image upload
            if ($request->hasFile('image')) {
                $oldImage = public_path('images/sliders/' . $slider->image);
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/sliders'), $imageName);
                $slider->image = $imageName;
            }

            // Update other fields
                $slider->title = $request->title;
                $slider->subtitle = $request->subtitle;
                $slider->image_url = $request->image_url;
                $slider->button_text = $request->button_text;
                $slider->button_link = $request->button_link;
                $slider->page = $request->page ?? 0;
                $slider->precedence = $request->precedence ?? 0;
                $slider->is_active = $request->is_active ?? false;
                $slider->starts_at = $request->starts_at;
                $slider->ends_at = $request->ends_at;

            $slider->save();

            return response()->json(['status' => 'success']);
        }

    public function deleteSlider($id)
        {
            try {
                $slider = Slider::find($id);

            if (!$slider) {
                return response()->json(['status' => 'error', 'message' => 'Slider not found.']);
            }

            // Delete image if exists
            if ($slider->image) {
                $imagePath = public_path('images/sliders/' . $slider->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
                if ($slider->delete()) {
                    return back()->with(['status' => 'success']);
                }
            

            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }
}
    

