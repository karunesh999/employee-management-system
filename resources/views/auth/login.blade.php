@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="card-title mb-3 text-center">Employee Login</h4>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
            <div class="text-center">
                <small>Don't have an account? <a href="{{ route('register') }}">Sign up</a></small>
            </div>
        </form>
    </div>
</div>
@endsection
