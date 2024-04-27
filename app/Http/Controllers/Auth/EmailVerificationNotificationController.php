<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $user = \App\Models\User::where('email', $request->user()->email)->first();

        if ($user) {
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                ['id' => $user->id, 'hash' => sha1($user->email)]
            );
            Mail::to($user->email)->send(new VerifyEmail($user, $verificationUrl));
            $status = 'Visszaigazoló link sikeresen elküldve! Ellenőrizd az e-mail címedet!';
            $messageType = 'status';
        } else {
            $status = 'Hiba történt. Kérlek jelezd a fejlesztőknek a hibát!';
            $messageType = 'error';
        }

        // Redirect back to the previous page with a status message
        return redirect()->back()->with($messageType, $status);
    }
}
