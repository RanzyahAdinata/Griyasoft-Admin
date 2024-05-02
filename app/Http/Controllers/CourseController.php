<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Video;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $videos = Video::all();
        return view('courses.index', compact('courses', 'videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'required|mimes:mp4|max:10240', // Max 10MB
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        $videoPath = $request->file('video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'thumbnail' => $thumbnailPath,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('courses.index')->with('success', 'Video added successfully.');
    }
    public function play($id)
    {
        $videos = Video::all();
        $video = Video::findOrFail($id);
        return view('courses.play', compact('videos','video'));
    }
}


    
