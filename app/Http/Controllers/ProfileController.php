<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }


    public function updateAvatar(Request $request)
    {
    $request->validate([
        'avatar' => 'required|image|max:2048', 
    ]);

    $user = auth()->user();

    // delete old avatar if it exists
    if ($user->avatar_url) {
        Storage::disk('public')->delete($user->avatar_url);
    }

    // store new avatar
    $path = $request->file('avatar')->store('avatars', 'public');
    $user->avatar_url = '/storage/' . $path; 
    $user->save();
    Inertia::share([
        'auth.user' => fn () => auth()->user(),
    ]);

    return back()->with('success', 'Avatar updated.');
    }

    /**
     * Update the user's profile information.
     */
   public function update(ProfileUpdateRequest $request): Response
{
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
        $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Inertia::render('Profile/Edit', [
        'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
        'status' => 'profile-updated',
    ]);
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
