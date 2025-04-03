<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Auth;

class OAuthClientController extends Controller
{
    public function index()
    {
        $clients = Client::where('user_id', Auth::id())->get();
        return view('oauth.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('oauth.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'redirect' => 'required|url',
        ]);

        $client = Client::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'redirect' => $request->redirect,
            'personal_access_client' => false,
            'password_client' => false,
            'revoked' => false,
        ]);

        return redirect()->route('oauth.clients.index')
            ->with('status', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        return view('oauth.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $request->validate([
            'name' => 'required|string|max:255',
            'redirect' => 'required|url',
        ]);

        $client->update([
            'name' => $request->name,
            'redirect' => $request->redirect,
        ]);

        return redirect()->route('oauth.clients.index')
            ->with('status', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('oauth.clients.index')
            ->with('status', 'Client deleted successfully.');
    }
}
