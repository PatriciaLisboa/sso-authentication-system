@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Enable Two Factor Authentication') }}</div>

                <div class="card-body">
                    <p>{{ __('To enable two-factor authentication, scan the QR code below with your authenticator app (like Google Authenticator) and enter the verification code.') }}</p>

                    <div class="text-center mb-4">
                        <img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl={{ urlencode($qrCodeUrl) }}" alt="QR Code">
                    </div>

                    <div class="text-center mb-4">
                        <p>{{ __('If you cannot scan the QR code, enter this code manually in your authenticator app:') }}</p>
                        <code>{{ $secret }}</code>
                    </div>

                    <form method="POST" action="{{ route('2fa.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="off" autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enable 2FA') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 