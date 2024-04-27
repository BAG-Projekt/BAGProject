<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if (! Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'A megadott jelenlegi jelszó nem egyezik a tárolttal.'])->withInput();
        }

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|confirmed',
        ], [
            'new_password.confirmed' => 'Az új jelszó és a megerősítése nem egyezik.',
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'A jelszó sikeresen módosítva.')->withInput();
    }
}
