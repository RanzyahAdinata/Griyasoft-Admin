<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Video;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $user = User::all();
        $sliders = Slider::all();
        $videos = Video::all();
        if($request->has('search')){
            $sliders = Slider::where('slug','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $sliders = Slider::all();
        }
        return view('blog.index' , compact('kategori', 'user', 'sliders', 'videos'));
    }

    public function detail($slug)
    {
        $sliders = Slider::where('slug', $slug)->first();
        // $sliders = Slider::all();
        $kategori = Kategori::all();
        $videos = Video::all();
        $user = User::all();

        return view('blog.detail-blog', [
            'sliders' => $sliders,
            'kategori' => $kategori,
            'user' => $user,
            'video' => $videos
        ]);
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

        return redirect()->route('blog.detail-blog')->with('success', 'Video added successfully.');
    }

    public function play($slug)
    {
        // $videos = Video::all();
        // $video = Slider::findOrFail($slug);
        // return view('blog.detail-blog', compact('videos','video'));

        // $sliders = Slider::where('slug', $slug)->first();
        $sliders = Slider::findOrFail($slug);
        $kategori = Kategori::all();
        $videos = Video::all();
        $user = User::all();

        return view('blog.detail-blog', compact('sliders', 'kategori','user', 'videos'));
    }
}
