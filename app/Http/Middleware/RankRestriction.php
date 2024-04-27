<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RankRestriction
{
    public function handle(Request $request, Closure $next, ...$ranks)
    {
        if (! Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        $allowedRanks = explode(':', implode(':', $ranks));

        if (! in_array($user->rank, $allowedRanks)) {
            return redirect('dashboard');
        }

        return $next($request);
    }
}
