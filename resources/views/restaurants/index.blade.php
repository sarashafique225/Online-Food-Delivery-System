@extends('layouts.app')
@section('title', 'Home')
@section('content')

<!-- HERO -->
<section class='hero-section text-center'>
  <div class='container'>
    <div id='timeGreeting' class='badge bg-danger mb-3 px-4 py-2' style='font-size:1rem'></div>
    <h1 class='display-4 fw-bold'>Hungry? We've Got You Covered.</h1>
    <p class='lead mt-2'>Order from the best restaurants in Lahore. Fast. Fresh. Always.</p>
    <form method='GET' action='/restaurants' class='search-wrapper d-flex mt-4 mx-auto' style='max-width:600px'>
      <input type='text' name='search' class='form-control form-control-lg'
             placeholder='Search restaurants...' value='{{ $search ?? "" }}'>
      <button class='btn btn-danger btn-lg px-4'>Search</button>
    </form>
  </div>
</section>

<!-- CATEGORIES -->
<section class='py-4 bg-white shadow-sm'>
  <div class='container text-center'>
    <h5 class='mb-3'>Browse by Category</h5>
    @php
      $cats = ['all'=>'🍽️ All','healthy'=>'🥗 Healthy','spicy'=>'🌶️ Spicy',
               'desi'=>'🍛 Desi','junk'=>'🍔 Fast Food','light'=>'🥙 Light Bites',
               'comfort'=>'☕ Comfort','sweet'=>'🍰 Desserts'];
    @endphp
    <div class='d-flex justify-content-center gap-3 flex-wrap mt-3'>
    @foreach($cats as $slug => $label)
        <a href='/restaurants?category={{ $slug }}'
           class='btn btn-outline-danger rounded-pill px-4'>
            {{ $label }}
        </a>
    @endforeach
</div>

<!-- RESTAURANT GRID -->
<section class='py-5'>
  <div class='container'>
    <div class='d-flex justify-content-between align-items-center mb-4'>
      <h2><strong>Restaurants Near You</strong>
        <small class='text-muted fs-5'>({{ $restaurants->total() }} found)</small>
      </h2>
    </div>
    @if($restaurants->count() == 0)
      <div class='text-center py-5'>
        <h4>😕 No restaurants found for this category.</h4>
        <a href='/restaurants' class='btn btn-danger mt-3'>Show All</a>
      </div>
    @else
    <div class='row g-4'>
      @foreach($restaurants as $r)
      <div class='col-xl-4 col-md-6'>
    <div class='card restaurant-card h-100 shadow-sm' style='position:relative;border-radius:15px;overflow:hidden'>
        @if($r->eco_friendly)
            <span class='badge bg-success eco-badge'>♻️ Eco</span>
        @endif
        <img src="{{ $r->image ? asset('storage/'.$r->image) : 'https://picsum.photos/seed/'.$r->slug.'/400/200' }}"
             alt="{{ $r->name }}"
             style='width:100%;height:270px;object-fit:cover;object-position:center center top bottom left right;display:block;'
             onerror="this.src='https://picsum.photos/seed/{{ $r->slug }}/400/200'">
        <div class='card-body'>
            <div class='d-flex justify-content-between align-items-start mb-1'>
                <h5 class='card-title mb-0'>{{ $r->name }}</h5>
                <span class='badge bg-{{ $r->is_open ? "success" : "secondary" }}'>
                    {{ $r->is_open ? "Open" : "Closed" }}
                </span>
            </div>
            <p class='text-muted small mb-2'>📍 {{ $r->address }}</p>
            <div class='d-flex gap-3 text-muted small flex-wrap'>
                <span>⭐ {{ number_format($r->rating, 1) }}</span>
                <span>🕐 {{ $r->delivery_time }} min</span>
                <span>🚚 Rs.{{ $r->delivery_fee }}</span>
            </div>
        </div>
        <div class='card-footer bg-transparent border-0 pb-3'>
            <a href="/restaurants/{{ $r->slug }}" class='btn btn-danger w-100 rounded-pill'>
                View Menu →
            </a>
        </div>
    </div>
</div>
      @endforeach
    </div>
    <div class='mt-4 d-flex justify-content-center'>{{ $restaurants->links() }}</div>
    @endif
  </div>
</section>

<!-- FLOATING AI BOT -->
<div style='position:fixed;bottom:30px;right:30px;z-index:1050'>
  <button class='btn btn-danger rounded-circle shadow-lg' style='width:65px;height:65px;font-size:1.8rem'
          data-bs-toggle='modal' data-bs-target='#moodBotModal' title='AI Food Mood Bot'>
    🤖
  </button>
</div>

<!-- AI BOT MODAL -->
<div class='modal fade' id='moodBotModal' tabindex='-1'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content border-0 shadow-lg'>
      <div class='modal-header text-white' style='background:#0f3460'>
        <h5 class='modal-title'>🤖 AI Food Mood Bot</h5>
        <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal'></button>
      </div>
      <div class='modal-body p-3'>
        <div id='chatWindow' class='mood-bot-window mb-3'>
          <div class='text-start mb-2'>
            <span class='chat-bubble-bot'>
              Hi! Tell me how you feel and I'll suggest the perfect food. Try: "I want something spicy" or "I feel bloated, need something light" 😊
            </span>
          </div>
        </div>
        <div class='d-flex gap-2'>
          <input type='text' id='moodInput' class='form-control'
                 placeholder='I feel bloated but want spicy...'
                 onkeydown='if(event.key==="Enter") askBot()'>
          <button class='btn btn-danger px-3' onclick='askBot()' id='askBtn'>Ask</button>
        </div>
        <div id='botResults' class='mt-3'></div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
// TIME GREETING
const h = new Date().getHours();
const greets = [
  [6,11,'🌅 Breakfast Fuel — Good Morning!'],
  [11,16,'☀️ Lunch Break — What are you craving?'],
  [16,21,'🌆 Dinner Time — Order something delicious!'],
  [0,6,'🌙 Midnight Cravings — We Never Close!']
];
const g = greets.find(([s,e]) => h >= s && h < e) || greets[3];
document.getElementById('timeGreeting').textContent = g[2];

// AI BOT
async function askBot() {
  const input = document.getElementById('moodInput');
  const mood  = input.value.trim();
  if (!mood) return;
  const win = document.getElementById('chatWindow');
  const btn = document.getElementById('askBtn');
  btn.disabled = true; btn.textContent = '...';
  win.innerHTML += `<div class='text-end mb-2'><span class='chat-bubble-user'>${mood}</span></div>`;
  input.value = '';
  try {
    const res = await fetch('/api/ai/recommend', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify({ mood: mood })
    });
    const data = await res.json();
    const foods = data.data || [];

    // Show health message first if exists
    if (data.health_message) {
      const alertColor = data.force_healthy ? '#dc3545' : '#0f3460';
      win.innerHTML += `<div class='text-start mb-2'>
        <span class='chat-bubble-bot' style='background:${alertColor}'>
          ${data.health_message}
        </span>
      </div>`;
    }

    // Show food suggestions
    if (foods.length > 0) {
      let list = foods.map(f =>
        `🍽️ <b>${f.name}</b> from <i>${f.restaurant ? f.restaurant.name : 'local'}</i><br>
         &nbsp;&nbsp;&nbsp;Rs.${f.price} &nbsp;|&nbsp; 🔥${f.calories} kcal
         ${f.is_healthy ? ' &nbsp;|&nbsp; 🥗 Healthy' : ''}`
      ).join('<br><br>');

      const reply = data.force_healthy
        ? `I'm recommending healthier options for you:<br><br>${list}`
        : `Based on your mood, I suggest:<br><br>${list}`;

      win.innerHTML += `<div class='text-start mb-2'>
        <span class='chat-bubble-bot'>${reply} 😋</span>
      </div>`;
    } else {
      win.innerHTML += `<div class='text-start mb-2'>
        <span class='chat-bubble-bot'>Try: "healthy", "spicy", "light", "desi", "sweet" 🤔</span>
      </div>`;
    }
  } catch(e) {
    win.innerHTML += `<div class='text-start mb-2'>
      <span class='chat-bubble-bot'>Connection error. Make sure server is running!</span>
    </div>`;
  }
  btn.disabled = false; btn.textContent = 'Ask';
  win.scrollTop = win.scrollHeight;
}
</script>
@endpush
