<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;

class Google2FAController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function enable2FA(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $this->google2fa->generateSecretKey();
            $user->save();
        }

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        return view('auth.2fa.enable', [
            'qrCodeUrl' => $qrCodeUrl,
            'secret' => $user->google2fa_secret
        ]);
    }

    public function confirm2FA(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            $user->google2fa_enabled = true;
            $user->save();
            return redirect()->route('home')->with('status', 'Two-factor authentication has been enabled.');
        }

        return back()->withErrors(['code' => 'Invalid verification code']);
    }

    public function disable2FA(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            $user->google2fa_enabled = false;
            $user->google2fa_secret = null;
            $user->save();
            return redirect()->route('home')->with('status', 'Two-factor authentication has been disabled.');
        }

        return back()->withErrors(['code' => 'Invalid verification code']);
    }

    public function verify2FA(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $user = Auth::user();
        $valid = $this->google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            session(['2fa_verified' => true]);
            return redirect()->intended();
        }

        return back()->withErrors(['code' => 'Invalid verification code']);
    }
}
