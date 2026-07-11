<nav class='navbar navbar-expand-lg navbar-dark' style='background:#1a1a2e;'>
  <div class='container'>
    <a class='navbar-brand text-danger' href='/'>🍔 FoodExpress</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#nav'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='nav'>
      <ul class='navbar-nav me-auto'>
        <li class='nav-item'><a class='nav-link' href='/'>Home</a></li>
        <li class='nav-item'><a class='nav-link' href='/restaurants'>Restaurants</a></li>
      </ul>
      <ul class='navbar-nav ms-auto align-items-center'>
        @auth
          <li class='nav-item me-2'>
            <a class='nav-link' href='/dashboard'>
              <i class='bi bi-speedometer2'></i> Dashboard
            </a>
          </li>
          <li class='nav-item me-2'>
    <a class='nav-link' href='/cart'>
      <i class='bi bi-cart3'></i> Cart
      <span class='badge bg-danger' id='cart-count'>0</span>
    </a>
</li>
          <li class='nav-item'>
            <form method='POST' action='/logout' class='d-inline'>
              @csrf
              <button class='btn btn-outline-danger btn-sm'>Logout</button>
            </form>
          </li>
        @else
          <li class='nav-item me-2'><a class='nav-link' href='/login'>Login</a></li>
          <li class='nav-item'><a class='btn btn-danger btn-sm' href='/register'>Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
