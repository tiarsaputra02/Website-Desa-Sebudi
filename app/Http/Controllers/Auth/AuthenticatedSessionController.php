<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
    $request->authenticate();

    $request->session()->regenerate();
        //
    // Ambil role dari relasi user -> employee -> role
    $role = auth()->user()->empeloyee->role->title;

    // Redirect sesuai role
    if ($role === 'Admin Utama') {
        return redirect('/dashboard');
    }

    if ($role === 'Admin Banjar Pura') {
        return redirect('/dashboard/pura');
    }

    if ($role === 'Admin Banjar Sorga') {
        return redirect('/dashboard/sorga');
    }

    if ($role === 'Admin Banjar Badeg Dukuh') {
        return redirect('/dashboard/dukuh');
    }

    // Default kalau role tidak dikenal
    return redirect('/');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
