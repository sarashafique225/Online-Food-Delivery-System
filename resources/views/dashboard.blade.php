@extends('layouts.app')
@section('title', 'My Dashboard')
@section('content')
<div class='container py-5'>

  @if(session('success'))
    <div class='alert alert-success alert-dismissible fade show'>
      {{ session('success') }}
      <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
    </div>
  @endif

  <div class='row mb-4'>
    <div class='col'>
      <h2>Welcome, {{ auth()->user()->name }}! 👋</h2>
      <p class='text-muted'>Here is your food and health summary this week.</p>
    </div>
  </div>

  <!-- HEALTH STATS CARDS -->
  <div class='row g-4 mb-5'>
    <!-- Health Grade -->
    <div class='col-md-3'>
      <div class='card text-center shadow-sm p-4'>
        <h6 class='text-muted mb-3'>Weekly Health Grade</h6>
        @php
          $colors = ['A'=>'#28a745','B'=>'#17a2b8','C'=>'#ffc107','D'=>'#dc3545'];
          $color  = $colors[$grade] ?? '#6c757d';
        @endphp
        <div class='health-grade-circle shadow mb-2' style='background:{{ $color }}; color:white;'>
          {{ $grade }}
        </div>
        @if($grade == 'D')
          <small class='text-danger'>Too much junk! Try eating healthy.</small>
        @elseif($grade == 'A')
          <small class='text-success'>Excellent! Keep it up!</small>
        @else
          <small class='text-muted'>Keep improving your diet!</small>
        @endif
      </div>
    </div>
    <!-- Weekly Calories -->
    <div class='col-md-3'>
  <div class='card text-center shadow-sm p-4'>
    <h6 class='text-muted mb-2'>Calories This Week</h6>
    <h2 class='text-danger'>{{ number_format($weeklyCalories) }}</h2>
    <small class='text-muted'>kcal consumed</small>
    <div class='progress mt-2 mb-1' style='height:10px;border-radius:10px'>
      @php $goalWeek = (auth()->user()->daily_calorie_goal ?? 2000) * 7; @endphp
      <div class='progress-bar bg-danger'
           style='width:{{ min(($weeklyCalories / $goalWeek) * 100, 100) }}%;border-radius:10px'>
      </div>
    </div>
    <small class='text-muted'>Goal: {{ number_format($goalWeek) }} kcal/week</small>
  </div>
</div>

    <!-- Healthy vs Junk -->
    <div class='col-md-3'>
      <div class='card text-center shadow-sm p-4'>
        <h6 class='text-muted mb-3'>Healthy Meals</h6>
        <h2 class='text-success'>{{ $healthyCount }}</h2>
        <small class='text-muted'>this week</small>
      </div>
    </div>
    <div class='col-md-3'>
      <div class='card text-center shadow-sm p-4'>
        <h6 class='text-muted mb-3'>Junk Meals</h6>
        <h2 class='text-warning'>{{ $junkCount }}</h2>
        <small class='text-muted'>this week</small>
      </div>
    </div>
  </div>

  <!-- ORDER HISTORY -->
  <h4 class='mb-3'>📋 Recent Orders</h4>
  @if($allOrders->count() == 0)
    <div class='alert alert-info'>No orders yet. <a href='/'>Order something!</a></div>
  @else
  <div class='table-responsive'>
    <table class='table table-hover bg-white rounded shadow-sm'>
      <thead class='table-dark'>
        <tr><th>#</th><th>Restaurant</th><th>Total</th><th>Calories</th><th>Status</th><th>Date</th></tr>
      </thead>
      <tbody>
        @foreach($allOrders as $order)
        <tr>
          <td>{{ $order->id }}</td>
          <td>{{ $order->restaurant->name }}</td>
          <td>Rs.{{ $order->total }}</td>
          <td>{{ $order->total_calories }} kcal</td>
          <td>
            <span class='badge bg-{{ $order->status=="delivered"?"success":($order->status=="pending"?"warning":"info") }}'>
              {{ ucfirst($order->status) }}
            </span>
          </td>
          <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>
@endsection
