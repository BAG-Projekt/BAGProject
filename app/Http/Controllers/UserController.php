<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'pnumber' => ['required', 'regex:/^(\+\d{1,3}[- ]?)?\d{10}$/'],
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'pnumber' => $request->pnumber,
        ]);

        return redirect(route('add'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (! $user) {
            return back()->withErrors('error', 'Felhasználó nem található')->withInput();
        }

        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'rank' => 'required|string',
            'pnumber' => 'required|string',
            'email' => 'required|email',
        ]);

        $user->update($request->all());

        return back()->with('success', 'Felhasználó sikeresen módosítva');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return back()->with('success', 'Felhasználó sikeresen törölve');
        } else {
            return back()->withErrors('error', 'Felhasználó nem található')->withInput();
        }
    }

    public function search(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                if (isset($request->filter['id'])) {
                    $q->orWhere('id', 'like', "%{$searchTerm}%");
                }
                if (isset($request->filter['name'])) {
                    $q->orWhere('name', 'like', "%{$searchTerm}%");
                }
                if (isset($request->filter['rank'])) {
                    $q->orWhere('rank', 'like', "%{$searchTerm}%");
                }
                if (isset($request->filter['created_at'])) {
                    $q->orWhere('created_at', 'like', "%{$searchTerm}%");
                }
                if (isset($request->filter['contact'])) {
                    $q->orWhere('email', 'like', "%{$searchTerm}%")
                        ->orWhere('pnumber', 'like', "%{$searchTerm}%");
                }
            });
        }

        $users = $query->get();

        return view('users', ['users' => $users]);
    }

}
