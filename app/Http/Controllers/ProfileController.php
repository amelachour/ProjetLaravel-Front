<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profil.profile', compact('user'));
    }


    public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'birthdate' => 'nullable|date',
        'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    $user = Auth::user();
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $profileData = $request->only(['phone_number', 'address', 'birthdate']);

    if ($request->hasFile('profile_picture')) {
        $profileData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}
