<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Auth;

class OAuthTokenController extends Controller
{
    public function index()
    {
        $tokens = Token::where('user_id', Auth::id())
            ->where('revoked', false)
            ->get();

        return view('oauth.tokens.index', compact('tokens'));
    }

    public function destroy(Token $token)
    {
        if ($token->user_id !== Auth::id()) {
            abort(403);
        }

        $token->revoke();

        return redirect()->route('oauth.tokens.index')
            ->with('status', 'Token revoked successfully.');
    }
}
