<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $siswa = Siswa::all();
        // $siswa = Siswa::OrderBy('nama', 'asc')->get();

        $absensi = Absensi::all();
        return view('absensi.index', compact('absensi', 'siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'keterangan' => 'required',
            'kegiatan' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'siswas_id' => 'required',   
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'kegiatan';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        Absensi::create($input);
        // $absensi = new Absensi;
        // $absensi->siswas_id = $request->siswas_id;
        // $absensi->kegiatan = $request->kegiatan;
        // $absensi->image = $image;
        // $absensi->siswas_id = $request->siswas_id;
        // $absensi->save();


        return redirect()->route('absensi.index')->with('success', 'Data Berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);

        if ($absensi->image) {
            $gambarPath = public_path('kegiatan/') . $absensi->image;
    
            if (File::exists($gambarPath)) {
                // Hapus file gambar
                File::delete($gambarPath);
            }
        }
 
        // Temukan data absensi yang akan dihapus
        // $absensi = Absensi::findOrFail($id);

        // // Dapatkan nama file gambar dari data absensi
        // $gambarFileName = $absensi->image; // Sesuaikan dengan nama kolom di tabel absensi yang menyimpan nama file

        // // Hapus data absensi dari database
        $absensi->delete();

        // // Hapus file gambar dari folder public jika file ada
        // if ($gambarFileName && Storage::disk('public')->exists($gambarFileName)) {
        //     Storage::disk('public')->delete($gambarFileName);
        // }

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus.');

    }

}
