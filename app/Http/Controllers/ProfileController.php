<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    

    public function index()
    {
        //
        $user = Auth::user()->name;
        return view('profile.index', compact('user'));
    }


    public function store(Request $request)
    {
        //
        $user = new User;
        $request->validate([
            'avatar' => 'required|avatar|mimes:jpeg,jpg,pnp,svg,gif|max:2048'
        ]);
        if ($request->hasfile('avatar')) {
            $file = $request->file('avatar');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('Avatar/', $filename);
            $user->image = $filename;
        }
        $user->save();
        return redirect()->back()->with('status', 'Student Image Added Successfully');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function updateProfileData(Request $request)
    {
        $user = Auth::user();

        // Validate form fields for updating profile info
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add any additional validation rules you need
        ]);

        // Update user's profile information
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle image upload and update user's profile_image field
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $imagePath = 'image/profile/';
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            // $profileImage->storeAs($imagePath, $imageName, 'public');
            $profileImage->move(public_path($imagePath), $imageName);

            // Delete old profile image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($imagePath . $user->profile_image);
            }

            // Update user's profile_image field in the database
            $user->profile_image = $imageName;
        }

        // Update user's password if provided
        if ($request->filled('new_password')) {
            // Validate password field
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            // Check if the provided current password matches the user's current password
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            // Update user's password
            $user->password = Hash::make($request->new_password);
        }

        // Save the updated user
        $user->save();

        return redirect()->back()->with('success', 'Profile information updated successfully.');
    }
}
