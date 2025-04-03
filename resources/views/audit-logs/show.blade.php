@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Audit Log Details</h2>
            <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Basic Information</h4>
                    <table class="table">
                        <tr>
                            <th>Date:</th>
                            <td>{{ $auditLog->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>User:</th>
                            <td>{{ $auditLog->user ? $auditLog->user->name : 'System' }}</td>
                        </tr>
                        <tr>
                            <th>Action:</th>
                            <td>
                                <span class="badge bg-{{ $auditLog->action === 'created' ? 'success' : ($auditLog->action === 'updated' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($auditLog->action) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Model:</th>
                            <td>{{ class_basename($auditLog->model_type) }} #{{ $auditLog->model_id }}</td>
                        </tr>
                        <tr>
                            <th>IP Address:</th>
                            <td>{{ $auditLog->ip_address }}</td>
                        </tr>
                        <tr>
                            <th>User Agent:</th>
                            <td>{{ $auditLog->user_agent }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h4>Changes</h4>
                    @if($auditLog->action === 'updated')
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Old Value</th>
                                        <th>New Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($auditLog->new_values as $key => $newValue)
                                        @if(isset($auditLog->old_values[$key]) && $auditLog->old_values[$key] !== $newValue)
                                            <tr>
                                                <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                                <td>{{ is_array($auditLog->old_values[$key]) ? json_encode($auditLog->old_values[$key]) : $auditLog->old_values[$key] }}</td>
                                                <td>{{ is_array($newValue) ? json_encode($newValue) : $newValue }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @elseif($auditLog->action === 'created')
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($auditLog->new_values as $key => $value)
                                        <tr>
                                            <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                                            <td>{{ is_array($value) ? json_encode($value) : $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No changes recorded for this action.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 