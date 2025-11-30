@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="card-title mb-3 text-center">Employee Sign Up</h4>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100 mb-2">Create Account</button>
            <div class="text-center">
                <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
            </div>
        </form>
    </div>
</div>
@endsection
