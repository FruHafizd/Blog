<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Exception;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function callback(Request $request)
    {
        try {
            // Menggunakan stateless untuk menghindari penyimpanan sesi OAuth
            $userFromGoogle = Socialite::driver('google')->stateless()->user();
            
            // Ambil atau buat user di database berdasarkan google id
            $userFromDatabase = User::updateOrCreate(
                ['google_id' => $userFromGoogle->getId()],
                [
                    'name' => $userFromGoogle->getName(),
                    'email' => $userFromGoogle->getEmail(),
                    'password' => bcrypt(Str::random(24)), // Increased to 24 characters
                    'email_verified_at' => now(), // Mark email as verified
                    ]
                );
                $userFromDatabase->assignRole('Basic-User');

            // Logout user saat ini jika ada
            if (Auth::check()) {
                Auth::logout();
            }

            // Hapus semua data session
            $request->session()->flush();

            // Login user
            Auth::login($userFromDatabase);

            // Regenerate session
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        } catch (Exception $e) {
            Log::error('Google authentication error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Autentikasi Google gagal. Silakan coba lagi.');
        }
    }
}