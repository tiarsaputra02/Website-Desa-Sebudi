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
    if ($role === 'Admin Desa') {
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

    if ($role === 'Admin Banjar Sebudi') {
        return redirect('/dashboard/sebudi');
    }

    if ($role === 'Admin Banjar Badeg Tengah') {
        return redirect('/dashboard/tengah');
    }

    if ($role === 'Admin Banjar Badeg Kelodan') {
        return redirect('/dashboard/kelodan');
    }

    if ($role === 'Admin Banjar Ancut') {
        return redirect('/dashboard/ancut');
    }

    if ($role === 'Admin Banjar Yeha') {
        return redirect('/dashboard/yeha');
    }

    if ($role === 'Admin Banjar Lebih') {
        return redirect('/dashboard/lebih');
    }

    if ($role === 'Admin Banjar Telung Buana') {
        return redirect('/dashboard/buana');
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
