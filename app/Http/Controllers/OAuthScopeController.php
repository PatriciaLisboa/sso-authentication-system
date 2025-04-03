<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Scope;
use Illuminate\Support\Facades\Auth;

class OAuthScopeController extends Controller
{
    public function index()
    {
        $scopes = Scope::all();
        return view('oauth.scopes.index', compact('scopes'));
    }

    public function create()
    {
        return view('oauth.scopes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:255|unique:oauth_scopes',
            'description' => 'required|string|max:255',
        ]);

        Scope::create([
            'id' => $request->id,
            'description' => $request->description,
        ]);

        return redirect()->route('oauth.scopes.index')
            ->with('status', 'Scope created successfully.');
    }

    public function edit(Scope $scope)
    {
        return view('oauth.scopes.edit', compact('scope'));
    }

    public function update(Request $request, Scope $scope)
    {
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        $scope->update([
            'description' => $request->description,
        ]);

        return redirect()->route('oauth.scopes.index')
            ->with('status', 'Scope updated successfully.');
    }

    public function destroy(Scope $scope)
    {
        $scope->delete();

        return redirect()->route('oauth.scopes.index')
            ->with('status', 'Scope deleted successfully.');
    }
}
