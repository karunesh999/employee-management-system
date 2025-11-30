@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Dashboard</h3>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Welcome, {{ $user->name }} </h5>
                    <p class="card-text mb-0">
                        You are logged in as <strong>{{ $user->is_admin ? 'Administrator' : 'Employee' }}</strong>.
                    </p>
                </div>
            </div>
        </div>

        @if($user->is_admin)
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Employees</h6>
                            <h4 class="card-title mb-0">Manage</h4>
                        </div>
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2 text-muted">Profile</h6>
                        <h4 class="card-title mb-0">My Details</h4>
                    </div>
                    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary btn-sm">Open</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
