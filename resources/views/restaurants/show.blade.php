@extends('layouts.app')
@section('title', $restaurant->name . ' Menu')
@section('content')
<div class='container-fluid px-4 py-4'>

  <!-- RESTAURANT HEADER -->
  <div class='row mb-4 align-items-center'>
    <div class='col-md-8'>
      <nav aria-label='breadcrumb'>
        <ol class='breadcrumb'>
          <li class='breadcrumb-item'><a href="/" class='text-danger'>Home</a></li>
          <li class='breadcrumb-item active'>{{ $restaurant->name }}</li>
        </ol>
      </nav>
      <h2 class='fw-bold'>{{ $restaurant->name }}</h2>
      <p class='text-muted mb-2'>📍 {{ $restaurant->address }}</p>
      <div class='d-flex flex-wrap gap-3 align-items-center'>
        <span class='badge bg-warning text-dark fs-6'>⭐ {{ number_format($restaurant->rating,1) }}</span>
        <span>🕐 {{ $restaurant->delivery_time }} min delivery</span>
        <span>🚚 Rs.{{ $restaurant->delivery_fee }} delivery fee</span>
        @if($restaurant->eco_friendly)
          <span class='badge bg-success'>♻️ Eco-Friendly</span>
        @endif
        <span class='badge bg-{{ $restaurant->is_open ? "success" : "secondary" }}'>
          {{ $restaurant->is_open ? "● Open Now" : "● Closed" }}
        </span>
      </div>
    </div>
  </div>

  <div class='row g-4'>
    <!-- LEFT: FOOD ITEMS -->
    <div class='col-lg-8'>
      @if($foodItems->count() == 0)
        <div class='alert alert-info'>No menu items available yet.</div>
      @endif
      <div class='row g-3'>
        @foreach($foodItems as $item)
        <div class='col-md-6'>
          <div class='card food-card h-100 shadow-sm'>
            <div style='position:relative'>
              <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://picsum.photos/seed/'.($item->id).'food/300/160' }}"
     class='card-img-top' style='height:155px;object-fit:cover'
     onerror="this.src='https://picsum.photos/seed/{{ $item->id }}/300/160'">
              @if($item->is_healthy)
                <span class='badge bg-success' style='position:absolute;top:8px;left:8px'>🥗 Healthy</span>
              @endif
            </div>
            <div class='card-body p-3'>
              <h6 class='fw-bold mb-1'>{{ $item->name }}</h6>
              <p class='text-muted small mb-2' style='font-size:0.82rem'>{{ Str::limit($item->description, 70) }}</p>
              <div class='d-flex justify-content-between align-items-center mb-2'>
                <span class='fw-bold text-danger fs-6'>Rs. {{ $item->price }}</span>
                <span class='text-muted small'>🔥 {{ $item->calories }} kcal</span>
              </div>
              <div class='row text-center small text-muted mb-2'>
                <div class='col'><b>{{ $item->protein }}g</b><br>Protein</div>
                <div class='col'><b>{{ $item->carbs }}g</b><br>Carbs</div>
                <div class='col'><b>{{ $item->fats }}g</b><br>Fats</div>
              </div>
              <!-- WHAT'S INSIDE -->
              @if($item->ingredients)
              <div class='mb-2'>
                <button class='btn btn-outline-secondary btn-sm w-100'
                        data-bs-toggle='collapse' data-bs-target='#ing{{ $item->id }}'>
                  🔍 What's Inside?
                </button>
                <div class='collapse mt-1' id='ing{{ $item->id }}'>
                  <div class='bg-light p-2 rounded small'>{{ $item->ingredients }}</div>
                </div>
              </div>
              @endif
            </div>
            <div class='card-footer bg-transparent border-0 pt-0 pb-3 px-3'>
              @auth
                <button class='btn btn-danger w-100 rounded-pill'
                  onclick='addToCart({{ $item->id }},
                    "{{ addslashes($item->name) }}",
                    {{ $item->price }},
                    {{ $item->calories }})'>
                  🛒 Add to Cart
                </button>
              @else
                <a href='/login' class='btn btn-outline-danger w-100 rounded-pill'>
                  Login to Order
                </a>
              @endauth
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- RIGHT: CART SIDEBAR -->
    <div class='col-lg-4'>
      <div class='cart-sidebar card border-0 shadow p-4' style='border-radius:15px'>
        <h5 class='fw-bold mb-3'>🛒 Your Cart
          <span id='cartCount' class='badge bg-danger ms-1'>0</span>
        </h5>

        <div id='cartItems' class='mb-3' style='min-height:60px'>
          <p class='text-muted small text-center py-2'>Cart is empty</p>
        </div>

        <!-- CALORIE BUDGET BAR -->
        @auth
        @php $goal = auth()->user()->daily_calorie_goal ?? 2000; @endphp
        <div class='bg-light rounded p-3 mb-3'>
          <div class='d-flex justify-content-between mb-1'>
            <small class='fw-bold'>🔥 Calorie Budget</small>
            <small><span id='cartCal'>0</span> / {{ $goal }} kcal</small>
          </div>
          <div class='progress mb-1' style='height:12px;border-radius:10px'>
            <div id='calBar' class='progress-bar bg-success'
                 style='width:0%;transition:width 0.5s ease;border-radius:10px'></div>
          </div>
          <small id='calWarning' class='text-muted'></small>
        </div>
        <script>var CALORIE_GOAL = {{ $goal }};</script>
        @endauth

        <hr>
        <div class='d-flex justify-content-between fw-bold mb-1'>
          <span>Subtotal:</span>
          <span>Rs. <span id='cartSubtotal'>0</span></span>
        </div>
        <div class='d-flex justify-content-between text-muted small mb-3'>
          <span>Delivery Fee:</span>
          <span>Rs. {{ $restaurant->delivery_fee }}</span>
        </div>
        <div class='d-flex justify-content-between fw-bold fs-5 text-danger mb-3'>
          <span>Total:</span>
          <span>Rs. <span id='cartTotal'>{{ $restaurant->delivery_fee }}</span></span>
        </div>

        @auth
          <form method='POST' action='/orders' id='orderForm'>
            @csrf
            <input type='hidden' name='restaurant_id' value='{{ $restaurant->id }}'>
            <input type='hidden' name='cart_data'       id='cartDataInput' value='[]'>
            <input type='hidden' name='total'           id='totalInput'    value='0'>
            <input type='hidden' name='total_calories'  id='calInput'      value='0'>
            <div class='mb-3'>
              <label class='form-label fw-semibold small'>📍 Delivery Address</label>
              <textarea name='delivery_address' class='form-control' rows='2'
                        placeholder='Enter your full delivery address' required></textarea>
            </div>
            <button type='submit' class='btn btn-danger w-100 btn-lg rounded-pill' id='orderBtn' disabled>
              Place Order 🎉
            </button>
            <p class='text-muted text-center small mt-2'>Add items to enable order button</p>
          </form>
        @else
          <a href='/login' class='btn btn-outline-danger w-100 rounded-pill btn-lg'>
            🔐 Login to Order
          </a>
        @endauth
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
var cart = [];
var subtotal = 0;
var totalCal = 0;
var deliveryFee = {{ $restaurant->delivery_fee }};
var calorieGoal = typeof CALORIE_GOAL !== 'undefined' ? CALORIE_GOAL : 2000;

function addToCart(id, name, price, cal) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ food_item_id: id, quantity: 1 })
    })
    .then(function(res) {
        if (res.ok || res.status === 302 || res.status === 200) {
            var existing = cart.find(function(i){ return i.id === id; });
            if (existing) {
                existing.qty++;
            } else {
                cart.push({ id: id, name: name, price: parseFloat(price), cal: parseInt(cal), qty: 1 });
            }
            subtotal += parseFloat(price);
            totalCal += parseInt(cal);
            renderCart();

            // Update navbar cart count
            var badge = document.getElementById('cart-count');
            if (badge) badge.textContent = cart.reduce(function(a,i){ return a + i.qty; }, 0);
        }
    })
    .catch(function(err) {
        // Still update visual even if fetch has issue
        var existing = cart.find(function(i){ return i.id === id; });
        if (existing) {
            existing.qty++;
        } else {
            cart.push({ id: id, name: name, price: parseFloat(price), cal: parseInt(cal), qty: 1 });
        }
        subtotal += parseFloat(price);
        totalCal += parseInt(cal);
        renderCart();
    });
}

function removeFromCart(id) {
    var item = cart.find(function(i){ return i.id === id; });
    if (!item) return;
    subtotal -= item.price * item.qty;
    totalCal -= item.cal * item.qty;
    cart = cart.filter(function(i){ return i.id !== id; });
    renderCart();
}

function renderCart() {
    var div = document.getElementById('cartItems');
    var count = document.getElementById('cartCount');
    var orderBtn = document.getElementById('orderBtn');

    if (cart.length === 0) {
        div.innerHTML = '<p class="text-muted small text-center py-2">Cart is empty</p>';
        if (orderBtn) orderBtn.disabled = true;
        if (count) count.textContent = '0';
    } else {
        var html = '';
        cart.forEach(function(item) {
            html += '<div class="d-flex justify-content-between align-items-center mb-2 small">';
            html += '<div><b>' + item.name + '</b> x' + item.qty + '</div>';
            html += '<div class="d-flex align-items-center gap-2">';
            html += '<span class="text-danger">Rs.' + (item.price * item.qty).toFixed(0) + '</span>';
            html += '<button class="btn btn-sm btn-outline-danger p-0 px-1" onclick="removeFromCart(' + item.id + ')">✕</button>';
            html += '</div></div>';
        });
        div.innerHTML = html;
        if (orderBtn) orderBtn.disabled = false;
        if (count) count.textContent = cart.reduce(function(a,i){ return a + i.qty; }, 0);
    }

    // Update totals
    var subtotalEl = document.getElementById('cartSubtotal');
    var totalEl = document.getElementById('cartTotal');
    var totalInput = document.getElementById('totalInput');
    var cartDataInput = document.getElementById('cartDataInput');
    var calInput = document.getElementById('calInput');

    if (subtotalEl) subtotalEl.textContent = subtotal.toFixed(0);
    if (totalEl) totalEl.textContent = (subtotal + deliveryFee).toFixed(0);
    if (totalInput) totalInput.value = subtotal + deliveryFee;
    if (cartDataInput) cartDataInput.value = JSON.stringify(cart);
    if (calInput) calInput.value = totalCal;

    // Calorie bar
    var calEl = document.getElementById('cartCal');
    var barEl = document.getElementById('calBar');
    var warnEl = document.getElementById('calWarning');

    if (calEl) calEl.textContent = totalCal;
    if (barEl) {
        var pct = Math.min((totalCal / calorieGoal) * 100, 100);
        barEl.style.width = pct + '%';
        barEl.className = 'progress-bar ' + (pct < 50 ? 'bg-success' : pct < 80 ? 'bg-warning' : 'bg-danger');
        if (warnEl) {
            if (pct >= 100) warnEl.textContent = '🚨 Over your daily limit!';
            else if (pct >= 80) warnEl.textContent = '⚠️ Almost at your limit!';
            else warnEl.textContent = '';
        }
    }
}
</script>
@endpush