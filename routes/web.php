<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Google2FAController;
use App\Http\Controllers\OAuthClientController;
use App\Http\Controllers\OAuthScopeController;
use App\Http\Controllers\OAuthTokenController;
use App\Http\Controllers\AuditLogController;
use App\Models\User;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rota temporária para criar usuário e cliente de teste
Route::get('/setup-test', function () {
    // Criar usuário de teste
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => Hash::make('password123'),
    ]);

    // Criar cliente OAuth
    $client = Client::create([
        'user_id' => $user->id,
        'name' => 'Test Client',
        'secret' => 'test-secret',
        'redirect' => 'http://localhost/callback',
        'personal_access_client' => false,
        'password_client' => false,
        'revoked' => false,
    ]);

    return "Test user and client created successfully!";
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 2FA Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/2fa/enable', [Google2FAController::class, 'enable2FA'])->name('2fa.enable');
    Route::post('/2fa/confirm', [Google2FAController::class, 'confirm2FA'])->name('2fa.confirm');
    Route::post('/2fa/disable', [Google2FAController::class, 'disable2FA'])->name('2fa.disable');
    Route::get('/2fa/verify', [Google2FAController::class, 'verify2FA'])->name('2fa.verify');
});

// OAuth Client Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/oauth/clients', [OAuthClientController::class, 'index'])->name('oauth.clients.index');
    Route::get('/oauth/clients/create', [OAuthClientController::class, 'create'])->name('oauth.clients.create');
    Route::post('/oauth/clients', [OAuthClientController::class, 'store'])->name('oauth.clients.store');
    Route::get('/oauth/clients/{client}/edit', [OAuthClientController::class, 'edit'])->name('oauth.clients.edit');
    Route::put('/oauth/clients/{client}', [OAuthClientController::class, 'update'])->name('oauth.clients.update');
    Route::delete('/oauth/clients/{client}', [OAuthClientController::class, 'destroy'])->name('oauth.clients.destroy');
});

// OAuth Scope Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/oauth/scopes', [OAuthScopeController::class, 'index'])->name('oauth.scopes.index');
    Route::get('/oauth/scopes/create', [OAuthScopeController::class, 'create'])->name('oauth.scopes.create');
    Route::post('/oauth/scopes', [OAuthScopeController::class, 'store'])->name('oauth.scopes.store');
    Route::get('/oauth/scopes/{scope}/edit', [OAuthScopeController::class, 'edit'])->name('oauth.scopes.edit');
    Route::put('/oauth/scopes/{scope}', [OAuthScopeController::class, 'update'])->name('oauth.scopes.update');
    Route::delete('/oauth/scopes/{scope}', [OAuthScopeController::class, 'destroy'])->name('oauth.scopes.destroy');
});

// OAuth Token Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/oauth/tokens', [OAuthTokenController::class, 'index'])->name('oauth.tokens.index');
    Route::delete('/oauth/tokens/{token}', [OAuthTokenController::class, 'destroy'])->name('oauth.tokens.destroy');
});

// Audit Log Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
    Route::get('/audit-logs/{auditLog}', [AuditLogController::class, 'show'])->name('audit-logs.show');
});

// Protected Routes
Route::middleware(['auth', '2fa'])->group(function () {
    // Add your protected routes here
});

// Rotas de autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
