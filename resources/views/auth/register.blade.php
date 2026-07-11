@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" style="background:#f8f9fa">
  <div class="card shadow p-4" style="width:100%;max-width:480px;border-radius:20px">
    <div class="text-center mb-4">
      <h2 class="text-danger fw-bold">🍔 FoodExpress</h2>
      <p class="text-muted">Create your account and start ordering!</p>
    </div>

    @if(isset($errors) && $errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="/register">
      @csrf
      <div class="mb-3">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text" name="name"
               class="form-control form-control-lg"
               value="{{ old('name') }}"
               placeholder="Your full name" required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Email Address</label>
        <input type="email" name="email"
               class="form-control form-control-lg"
               value="{{ old('email') }}"
               placeholder="your@email.com" required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Password</label>
        <input type="password" name="password"
               class="form-control form-control-lg"
               placeholder="Minimum 8 characters" required>
      </div>
      <div class="mb-3">
        <label class="form-label fw-semibold">Confirm Password</label>
        <input type="password" name="password_confirmation"
               class="form-control form-control-lg"
               placeholder="Repeat your password" required>
      </div>
      <div class="mb-4">
        <label class="form-label fw-semibold">
          Daily Calorie Goal
          <small class="text-muted fw-normal">(optional, default 2000)</small>
        </label>
        <input type="number" name="daily_calorie_goal"
               class="form-control form-control-lg"
               placeholder="e.g. 2000" min="500" max="5000" value="2000">
      </div>
      <button type="submit" class="btn btn-danger w-100 btn-lg rounded-pill mb-3">
        Create Account 🎉
      </button>
      <div class="text-center">
        <span class="text-muted">Already have an account? </span>
        <a href="/login" class="text-danger fw-semibold">Sign in here</a>
      </div>
    </form>
  </div>
</div>
@endsection