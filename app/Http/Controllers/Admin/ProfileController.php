<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.profile', compact('admin'));
    }

    /**
     * Update the admin's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::guard('admin')->user();

        $admin->fill($request->validated());

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        if ($admin->isDirty('email')) {
            $admin->email_verified_at = null;
        }

        $admin->save();

        return Redirect::route('admin.profile.edit')->with('status', 'Profile updated successfully!');
    }

}
