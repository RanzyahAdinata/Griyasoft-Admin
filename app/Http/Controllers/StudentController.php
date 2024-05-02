<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; // Pastikan nama model disesuaikan
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;


class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $users = User::all();
        return view('students.index', compact('students', 'users'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'bio' => 'nullable|string',
            'status' => 'required'
        ]);

        $input = $request->all();



        Student::create($input);

        return redirect()->route('activeStudent.index')->with('success', 'Student added successfully.');
    }

    // Tambahkan method lain seperti edit, update, delete sesuai kebutuhan

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $student = Student::findOrFail($id);
        $users = User::all();
        return view('students.edit', compact('student', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'status' => 'required'
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = Student::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('student_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $student->update($validatedData);

        return redirect()->route('activeStudent.index')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        if ($student->image) {
            $gambarPath = public_path('gambar_admin/') . $student->image;

            if (File::exists($gambarPath)) {
                // Hapus file gambar
                File::delete($gambarPath);
            }
        }

        $student->delete();

        return redirect()->route('activeStudent.index')->with('success', 'Data absensi berhasil dihapus.');
    }

}