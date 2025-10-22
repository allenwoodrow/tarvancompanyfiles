<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order; // Add this import
use App\Models\Address; // Add this if you have Address model

class ProfileController extends Controller
{
    public function account(Request $request): View
    {
        return view('profile.account', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */

    public function edit(Request $request)
    {
        // Get user's orders
        $orders = Order::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->take(10) // Last 10 orders
                    ->get();

        return view('profile.account', [
            'orders' => $orders,
            'user' => $request->user() // Add this line
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
