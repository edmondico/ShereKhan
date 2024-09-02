<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        Log::info('Loading profile edit view for user: ' . $request->user()->id);
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        Log::info('Updating profile for user: ' . $request->user()->id);
        Log::info('Request data: ', $request->all());

        $validatedData = $request->validated();
        Log::info('Validated Data: ', $validatedData);

        $user = $request->user();
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->locale = $request->input('locale', $user->locale);
        $user->theme = $request->input('theme', $user->theme);
        
        $user->save();

        Log::info('User updated: ', $user->toArray());

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        Log::info('Updating password for user: ' . $request->user()->id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return Redirect::route('profile.edit')->withErrors(['current_password' => 'Current password does not match.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Log::info('Password updated for user: ' . $user->id);

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }
}
