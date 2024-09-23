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
        // Ambil post berdasarkan slug
        $post = Posts   ::where('id', $request->id)->first();

        // Periksa apakah post ada dan pengguna adalah pemiliknya
        if (!$post || (Auth::check() && Auth::id() !== $post->user_id)) {
            return redirect()->route('homepage')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
