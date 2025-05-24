<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function Event()
    {
        return view('backend.pages.event.new_event');
    }
    public function storeEvent(Request $request)
    {
        // return response()->json($request->all());
        $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'organizer' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        $timestamp = time();
    
        // Banner upload
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $bannerName = date('Y-m-d') . uniqid() . time(). '_banner.' . $request->banner->extension();
            $request->banner->move(public_path('images/events/banners'), $bannerName);
            $bannerPath = 'images/events/banners/' . $bannerName;
        }
    
        // Thumbnail upload
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailName = date('Y-m-d') . uniqid() . time() . '_thumbnail.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images/events/thumbnails'), $thumbnailName);
            $thumbnailPath = 'images/events/thumbnails/' . $thumbnailName;
        }
    
        // Gallery images upload
        $galleryPaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $galleryName = date('Y-m-d') . uniqid() . time() . "_gallery_$index." . $image->extension();
                $image->move(public_path('images/events/gallery'), $galleryName);
                $galleryPaths[] = 'images/events/gallery/' . $galleryName;
            }
        }
    
        // Store event in database
        Event::create([
            'event_name' => $request->event_name,
            'slug' => Str::slug($request->event_name),
            'description' => $request->description,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'images' => json_encode($galleryPaths),
            'banner' => $bannerPath,
            'thumbnail' => $thumbnailPath,
            'organizer' => $request->organizer,
        ]);
    
        return response()->json(['message' => 'Event created successfully']);
    }

    public function viewEvent(){
        $events = Event::all();
        return view('backend.pages.event.fetch_event', compact('events'));
     }
     public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id',
            'event_name' => 'required|string',
            'location' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $event = Event::findOrFail($request->id);

            $event->update([
                'event_name' => $request->event_name,
                'location' => $request->location,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public function delete($id){
        try {
           $event =  Event::findOrFail($id);
           $imagePath = public_path('images/events/images' . $event->image);
           if (File::exists($imagePath)) {
               File::delete($imagePath);
           }
           if ($event->delete()) {
            return back()->with(['status' => 'Data Deleted Successfully']);
           }
        } catch (\Throwable $th) {
    
        }
    }

}
