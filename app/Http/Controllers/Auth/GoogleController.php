<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            // cek user berdasarkan google_id
            $user = User::where('google_id', $googleUser->getId())->first();

            if (!$user) {
                // kalau belum ada user dengan google_id, cek email
                $user = User::where('email', $googleUser->getEmail())->first();

                if ($user) {
                    // update google_id di user lama
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'is_verified' => 1,
                    ]);
                } else {
                    // kalau belum ada sama sekali, buat user baru
                    $user = User::create([
                        'name'       => $googleUser->getName(),
                        'email'      => $googleUser->getEmail(),
                        'google_id'  => $googleUser->getId(),
                        'password'   => bcrypt(Str::random(16)),
                        'is_verified'=> 1,
                        'role'       => 'user', // default role
                    ]);
                }
            }

            Auth::login($user,true);

            return redirect()->intended('/courses')->with('success', 'You have successfully logged in with Google.');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong!');
        }
    }
}
