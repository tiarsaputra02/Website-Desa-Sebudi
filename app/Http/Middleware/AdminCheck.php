<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Empeloyee;
class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
     public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Pastikan user login
        $user = auth()->user();
        if (!$user) {
            abort(401, 'Harus login untuk mengakses');
        }

        // Ambil employee
        $employee = Empeloyee::with('role')->find($user->employe_id);
        if (!$employee) {
            abort(403, 'Akun tidak memiliki data employee');
        }

        // Simpan ke session kalau mau dipakai
        session()->put('employee_id', $employee->id);
        session()->put('role', $employee->role->title);

        // Cek role
        if (!in_array($employee->role->title, $roles)) {
            abort(403, 'Tidak memiliki akses');
        }

        return $next($request);
    }
}
