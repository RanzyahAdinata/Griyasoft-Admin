<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades;



class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $user = User::all();
        $kategori = Kategori::all();
        return view('video.index', compact('videos', 'kategori', 'user'));
    }

    public function create()
    {
        $user = User::all();
        $kategori = Kategori::all();
        return view('video.create', compact('kategori', 'user'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'file_path' => 'mimes:mp4|max:20480', // Maksimal ukuran 20MB
            'kategori_id' => 'required',
            'user_id' => 'required',
            'description' => 'required',
        ]);

        $videoFile = $request->file('file_path');
        $fileName = time() . '_' . $videoFile->getClientOriginalName();
        $videoFile->move(public_path('videos'), $fileName);

        Video::create([
            'title' => $data['title'],
            'kategori_id' => $data['kategori_id'],
            'user_id' => $data['user_id'],
            'description' => $data['description'],
            'file_path' => 'videos/' . $fileName,

        ]);

        return redirect()->route('videos.index')->with('success', 'Video added successfully');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        $kategori = Kategori::all();
        return view('video.edit', compact('video', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'file_path' => 'nullable|mimes:mp4|max:20480', // Maksimal ukuran 20MB
            'kategori_id' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('file_path')) {
            $videoFile = $request->file('file_path');
            $fileName = time() . '_' . $videoFile->getClientOriginalName();
            $videoFile->move(public_path('videos'), $fileName);

            // Hapus file video lama jika ada
            if ($video->file_path) {
                Storage::delete($video->file_path);
            }

            $video->update([
                'file_path' => 'videos' . $fileName,
            ]);
        }

        $video->update([
            'title' => $data['title'],
            'kategori_id' => $data['kategori_id'],
            'user_id' => $data['user_id'],
            'description' => $data['description'],
        ]);


        return redirect()->route('videos.index')->with('success', 'Video updated successfully');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully');
    }

    public function play($id)
    {
        $video = Video::findOrFail($id);
        return view('videos.play', compact('video'));
    }

    public function delete($id)
    {
        // Cari video berdasarkan ID
        $video = Video::findOrFail($id);

        // Jika video tidak ditemukan, kembalikan respons dengan pesan error
        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }

        // Hapus file video dari penyimpanan (storage)
        File::delete('public/videos/' . $video->file_path);
        // if ($video->file_path) {
        //     $gambarPath = public_path('videos/') . $video->file_path;

        //     if (File::exists($gambarPath)) {
        //         // Hapus file gambar
        //         File::delete($gambarPath);
        //     }
        // }

        // Hapus record video dari database
        $video->delete();

        // Kembalikan respons sukses
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
