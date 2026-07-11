@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background:#f8f9fa">
  <div class="card shadow p-4" style="width:100%;max-width:420px;border-radius:20px">
    <div class="text-center mb-4">
      <h2 class="text-danger fw-bold">🍔 FoodExpress</h2>
      <p class="text-muted">Welcome back! Sign in to order.</p>
    </div>

    @if(session()->has('errors') || (isset($errors) && $errors->any()))
      <div class="alert alert-danger">
        {{ $errors->first() }}
      </div>
    @endif

    @if(session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="/login">
      @csrf
      <div class="mb-3">
        <label class="form-label fw-semibold">Email Address</label>
        <input type="email" name="email"
               class="form-control form-control-lg"
               value="{{ old('email') }}"
               placeholder="your@email.com" required autofocus>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input type="password" name="password"
               class="form-control form-control-lg"
               placeholder="Your password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-danger w-100 btn-lg rounded-pill mb-3">
        Sign In
      </button>
      <div class="text-center">
        <span class="text-muted">Don't have an account? </span>
        <a href="/register" class="text-danger fw-semibold">Register here</a>
      </div>
    </form>
  </div>
</div>
@endsection