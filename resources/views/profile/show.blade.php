@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">My Profile</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <div class="mb-3">
                    @if($user->photo)
                        <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle" style="width:120px;height:120px;object-fit:cover;">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-inline-flex justify-content-center align-items-center" style="width:120px;height:120px;font-size:48px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h5>{{ $user->name }}</h5>
                <p class="mb-1">{{ $user->email }}</p>
                <p class="text-muted mb-1">{{ $user->department ?? 'No department set' }}</p>
                <p class="text-muted mb-3">{{ $user->phone ?? 'No phone set' }}</p>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
@endsection
