<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $siswa = Siswa::where('nama','LIKE','%' .$request->search.'%')->paginate(5);
        }else{
            $siswa = Siswa::all();
        }

        return view('siswa.index', compact('siswa'));
    }

    public function deleteAll(Request $request){
        
        $ids = $request->ids;
        Siswa::whereIn('id',$ids)->delete();
        return response()->json(["success"=> "Data siswa terpilih terlah terhapus!"]);
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
        // $insert = Siswa::create([
        //     'nama' => $request->nama,
        //     'telp' => $request->telp,
        //     'sekolah' => $request->sekolah,
        //     'alamat' => $request->alamat,
        // ]);
        // if ($insert) {
        //     return redirect('/siswa');
        // }
        $this->validate($request, [
            'nama' => 'required',
            'telp' => 'required',
            'sekolah' => 'required',
            'alamat' => 'required',
        ]);


        $siswa = new Siswa;
        $siswa->nama = $request->nama;
        $siswa->telp = $request->telp;
        $siswa->sekolah = $request->sekolah;
        $siswa->alamat = $request->alamat;
        $siswa->save();


        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
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
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findOrFail($id);

        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
        $siswa->nama = $request->nama;
        $siswa->telp = $request->telp;
        $siswa->sekolah = $request->sekolah;
        $siswa->alamat = $request->alamat;
        $siswa->update();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    //     $siswa = Siswa::find($id);
    //     // $siswa->delete();
    //     $siswa->delete();
    //     return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');

    // }

    public function delete($id)
    {
        $delete = Siswa::destroy($id);

        if( $delete == 1){
            $success = true;
            $message = "Data Siswa Berhasil Dihapus";
        } else {
            $success = true;
            $message = "Data Siswa Tidak ditemukan";
        }

        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();
        $data->move('SiswaData', $namafile);

        Excel::import(new SiswaImport, \public_path('/SiswaData/'.$namafile));
        return redirect()->back();
    }

    public function multiDelete(Request $request) 
{
    Siswa::whereIn('id', $request->get('selected'))->delete();

    return response("Selected Student deleted successfully.", 200);
}
}
