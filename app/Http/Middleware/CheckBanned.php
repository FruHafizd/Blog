<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah request adalah untuk login atau register
        if ($request->is('login') || $request->is('register')) {
            // Memeriksa apakah metode request adalah POST
            if ($request->isMethod('post')) {
                // Mencari user berdasarkan email yang dikirimkan dalam request
                $user = \App\Models\User::where('email', $request->email)->first();
                
                // Memeriksa apakah user ditemukan dan jika akun dibanned hingga waktu tertentu
                if ($user && $user->banned_until && now()->lessThan($user->banned_until)) {
                    // Menghitung jumlah hari banned
                    $banned_days = now()->diffInDays($user->banned_until);
                    $banned_days = round($banned_days); // Membulatkan hasil ke bilangan bulat
                    
                    // Jika akun sudah dibanned lebih dari 14 hari, tampilkan pesan umum
                    if ($banned_days > 14) {
                        $message = 'Your account has been suspended. Please contact administrator.';
                    } else {
                        // Menentukan label jamak untuk hari
                        $dayLabel = $banned_days === 1 ? 'day' : 'days'; // Menggunakan logika untuk menentukan bentuk jamak
                        // Membuat pesan yang menyebutkan berapa lama akun dibanned
                        $message = 'Your account has been suspended for '.$banned_days.' '.$dayLabel.'. Please contact administrator.';
                    }
                    
                    // Mengarahkan ke route login dengan pesan yang telah dibuat
                    return redirect()->route('login')->withMessage($message);
                }
            }
        } 
        // Jika user sudah login dan akun dibanned
        else if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            // Menghitung jumlah hari banned
            $banned_days = now()->diffInDays(auth()->user()->banned_until);
            $banned_days = round($banned_days); // Membulatkan hasil ke bilangan bulat
            Auth::logout(); // Logout user
            
            // Jika akun sudah dibanned lebih dari 14 hari, tampilkan pesan umum
            if ($banned_days > 14) {
                $message = 'Your account has been suspended. Please contact administrator.';
            } else {
                // Menentukan label jamak untuk hari
                $dayLabel = $banned_days === 1 ? 'day' : 'days'; // Menggunakan logika untuk menentukan bentuk jamak
                // Membuat pesan yang menyebutkan berapa lama akun dibanned
                $message = 'Your account has been suspended for '.$banned_days.' '.$dayLabel.'. Please contact administrator.';
            }
            
            // Mengarahkan ke route login dengan pesan yang telah dibuat
            return redirect()->route('login')->withMessage($message);
        }
        
        // Melanjutkan request ke middleware selanjutnya jika tidak ada masalah
        return $next($request);
    }
}
