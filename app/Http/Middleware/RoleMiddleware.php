<?php

// namespace App\Http\Middleware;

// // use Closure;
// // use Illuminate\Http\Request;
// // use Illuminate\Support\Facades\Auth;

// // class RoleMiddleware
// // {
// //     /**
// //      * Handle an incoming request.
// //      *
// //      * @param  \Illuminate\Http\Request  $request
// //      * @param  \Closure  $next
// //      * @param  string  $role
// //      * @return mixed
// //      */
// //     public function handle(Request $request, Closure $next, $role)
// //     {
// //         // Ambil user yang sedang login
// //         $user = Auth::user();

// //         // Cek apakah user memiliki role yang sesuai
// //         if (!$user || $user->role !== $role) {
// //             return redirect()->route('login')->with('error', 'Unauthorized Access');
// //         }

// //         return $next($request);
// //     }
// // }

// // use Closure;
// // use Illuminate\Http\Request;
// // use Illuminate\Support\Facades\Auth; // Pastikan Auth diimpor

// // class RoleMiddleware
// // {
// //     public function handle(Request $request, Closure $next, $role)
// //     {
// //         // Menggunakan Auth untuk memeriksa status login dan role
// //         if (Auth::check() && Auth::user()->role !== $role) {
// //             return redirect()->route('login')->with('error', 'Unauthorized Access');
// //         }

// //         return $next($request);
// //     }
// // }


// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; // Import Auth Facade

// class RoleMiddleware
// {
//     public function handle(Request $request, Closure $next, $role)
//     {
//         // Check if the authenticated user's role matches the expected role
//         if (Auth::user() && Auth::user()->role !== $role) {
//             return redirect()->route('login')->with('error', 'Unauthorized Access');
//         }

//         return $next($request);
//     }
// }


// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

// class RoleMiddleware
// {
//     public function handle(Request $request, Closure $next, $role)
//     {
//         // Periksa apakah pengguna yang sedang login memiliki role yang sesuai
//         if (Auth::check() && Auth::user()->role !== $role) {
//             return redirect()->route('login')->with('error', 'Unauthorized Access');
//         }

//         return $next($request);
//     }
// }


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        return redirect('/');
    }
}