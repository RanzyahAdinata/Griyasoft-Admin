<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        $user = User::all();
        $sliders = Slider::all();
        if($request->has('search')){
            $sliders = Slider::where('judul','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $sliders = Slider::all();
        }

        return view('slider.index', compact('kategori', 'user', 'sliders'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $user = User::all();
        $sliders = Slider::all();
        return view('slider.create', compact('kategori', 'user', 'sliders'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:4',
            'body' => 'required',
            'gambar_konten' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'is_active' => 'required'
        ]);

        // $videoFile = $request->file('file_path');
        // $fileName = time() . '_' . $videoFile->getClientOriginalName();
        // $videoFile->move(public_path('Video/konten'), $fileName);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);
        $data['user_id'] = Auth::id();
        $data['views'] = 0;
        // $data['file_path'] = 'Video/konten' . $fileName;
        // $data['gambar_konten'] = $request->file('gambar_konten')->store('sliders');
        if ($gambar_konten = $request->file('gambar_konten')) {
            $destinationPath = 'storage/konten';
            $profileImage = date('YmdHis') . "." . $gambar_konten->getClientOriginalExtension();
            $gambar_konten->move($destinationPath, $profileImage);
            $data['gambar_konten'] = "$profileImage";
        }

        if ($file_path = $request->file('file_path')) {
            $destinationPath = 'Video/konten';
            $profileImage = date('YmdHis') . "." . $file_path->getClientOriginalExtension();
            $file_path->move($destinationPath, $profileImage);
            $data['file_path'] = "$profileImage";
        }

        Slider::create($data);
        
        // Slider::create($data);

        return redirect()->route('slider.index')->with(['success' => 'Data berhasil disimpan']);
    }


    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $sliders = Slider::find($id);
        $kategori = Kategori::all();
        $sliders = Slider::findOrFail($id);

        return view('slider.edit', compact('sliders', 'kategori'));

    }

    public function update(Request $request, Slider $sliders, $id)
    {   
        $this->validate($request, [
            'judul' => 'required|min:4',
            'body' => 'required',
            'gambar_konten' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);


        $data = $request->all();
        $sliders = Slider::find($id);
        $sliders->judul = $request->judul;
        $sliders->body = $request->body;
        $sliders->slug = Str::slug($request->judul);
        $sliders->kategori_id = $request->kategori_id;
        $sliders->is_active = $request->is_active;
        $sliders->user_id = Auth::id();
        if ($gambar_konten = $request->file('gambar_konten')) {
            $destinationPath = 'storage/konten';
            $profileImage = date('YmdHis') . "." . $gambar_konten->getClientOriginalExtension();
            $gambar_konten->move($destinationPath, $profileImage);
            $data['gambar_konten'] = "$profileImage";
        }else{
            unset($sliders['gambar_konten']);
        }
        
        if ($file_path = $request->file('file_path')) {
            $destinationPath = 'Video/konten';
            $profileImage = date('YmdHis') . "." . $file_path->getClientOriginalExtension();
            $file_path->move($destinationPath, $profileImage);
            $data['file_path'] = "$profileImage";
        }else{
            unset($sliders['file_path']);
        }
        $sliders->update($data);
        return redirect()->route('slider.index')->with(['success' => 'Data berhasil tersimpan']);
    }


    public function delete($id)
    {

        $sliders = Slider::findOrFail($id);

        if ($sliders->gambar_konten) {
            $gambarPath = public_path('storage/konten/') . $sliders->gambar_konten;
    
            if (File::exists($gambarPath)) {
                // Hapus file gambar
                File::delete($gambarPath);
            }
        }

        $sliders->delete();


        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function play($slug)
    {
        $sliders = Slider::findOrFail($slug);
        return view('slider.play', compact('sliders'));
    }
}

