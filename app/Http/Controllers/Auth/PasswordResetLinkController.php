<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            $token = app('auth.password.broker')->createToken($user);

            Mail::to($request->email)->send(new PasswordReset($token, $request->email));
            $status = 'Helyreállító link sikeresen elküldve! Ellenőrizd az e-mail címedet!';
            $messageType = 'status';
        } else {
            $status = 'Felhasználó nem található. Kérlek ellenőrizd az e-mail címet és próbáld újra.';
            $messageType = 'error';
        }

        return redirect()->back()->with($messageType, $status);
    }
}
