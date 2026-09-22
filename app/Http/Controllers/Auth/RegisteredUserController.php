<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenoms' => ['nullable', 'string', 'max:255'],
            'fonction' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cgu' => ['accepted'],
        ]);

        $user = User::create([
            'nom' => $data['nom'],
            'prenoms' => $data['prenoms'] ?? null,
            'fonction' => $data['fonction'] ?? null,
            'contact' => $data['contact'] ?? null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Role::findOrCreate('membre', 'web');
        $user->assignRole('membre');

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
