<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Slider;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Student;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori = Kategori::all();
        $user = User::all();
        $sliders = Slider::all();
        $siswa = Siswa::count();
        $slider = Slider::count();
        $activeStudents = Student::all();
        $video = Video::count();

        return view('home', compact('siswa', 'slider', 'sliders', 'kategori', 'user','activeStudents', 'video'));
    }

}
