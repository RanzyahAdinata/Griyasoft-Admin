<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate();
        // $user = User::OrderBy('roles', 'asc')->get();

        return view('users.index', compact('users'));
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation as needed
            'role' => ''
            
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('image/profile', 'public');
            $data['profile_image'] = $imagePath;
        }

        $data['password'] = Hash::make($data['password']); // Enkripsi password

        User::create($data);

        return redirect()->route('user.index')->with('success', 'User added successfully');
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
        //
        $user = User::findOrFail($id);

        if ($user->profile_image) {
            $gambarPath = public_path('image/profile/') . $user->profile_image;
    
            if (File::exists($gambarPath)) {
                // Hapus file gambar
                File::delete($gambarPath);
            }
        }

        $user->delete();


        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }

    public function delete($id) {
        $user = User::findOrFail($id);

        if ($user->profile_image) {
            $gambarPath = public_path('image/profile/') . $user->profile_image;
    
            if (File::exists($gambarPath)) {
                // Hapus file gambar
                File::delete($gambarPath);
            }
        }

        $user->delete();


        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
