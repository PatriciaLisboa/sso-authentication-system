@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('OAuth Access Tokens') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Scopes') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tokens as $token)
                                <tr>
                                    <td>{{ $token->client->name }}</td>
                                    <td>
                                        @foreach($token->scopes as $scope)
                                            <span class="badge bg-primary">{{ $scope }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $token->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <form action="{{ route('oauth.tokens.destroy', $token) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure you want to revoke this token?') }}')">{{ __('Revoke') }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 