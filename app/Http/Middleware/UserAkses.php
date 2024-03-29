<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ... $role)
    {
        if (in_array(auth()->user()->role, $role)){
            return $next($request);
        }

        $response = [
            'status' => 'error',
            'message' => 'Anda Tidak Diperbolehkan Untuk Masuk Ke Halaman Ini',
            'additional_info' => 'Role yang diperlukan: ' . implode(', ', $role),
        ];
    
        return response()->json($response, 403);
    }
}
