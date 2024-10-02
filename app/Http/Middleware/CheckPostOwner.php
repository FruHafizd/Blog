<?php

namespace App\Http\Middleware;

use App\Models\Posts;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPostOwner
{
    public function handle(Request $request, Closure $next)
    {
        $postId = $request->route('id');
        // Menggunakan $request->route('id') lebih aman karena mengambil nilai dari parameter rute, bukan dari query string yang bisa dimanipulasi.

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page');
        }

        // Ambil post berdasarkan ID
        $post = Posts::findOrFail($postId);

        // Periksa apakah pengguna adalah pemiliknya
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Unauthorized action');
        }

        return $next($request);
    }
}
