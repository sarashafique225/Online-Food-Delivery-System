<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FoodExpress - @yield('title', 'Home')</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css' rel='stylesheet'>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; }
        .navbar-brand { font-size: 1.5rem; font-weight: 800; }
        .restaurant-card { transition: transform 0.3s, box-shadow 0.3s; border: none; border-radius: 15px; overflow: hidden; }
        .restaurant-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); }
        .hero-section { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); color: white; padding: 100px 0; }
        .hero-section h1 { font-size: 3.5rem; font-weight: 800; }
        .search-wrapper { max-width: 600px; margin: 30px auto 0; }
        .search-wrapper input { border-radius: 50px 0 0 50px; border: none; padding: 15px 25px; font-size: 1rem; }
        .search-wrapper button { border-radius: 0 50px 50px 0; padding: 15px 30px; font-size: 1rem; }
        .category-pill { display: inline-block; padding: 8px 20px; border-radius: 50px; background: white;
                         border: 2px solid #dee2e6; cursor: pointer; transition: all 0.3s; text-decoration: none; color: #333; margin: 5px; }
        .category-pill:hover, .category-pill.active { background: #dc3545; border-color: #dc3545; color: white; }
        .eco-badge { position: absolute; top: 10px; right: 10px; z-index: 1; }
        .calorie-bar { background: white; border-radius: 10px; padding: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .health-grade-circle { width: 90px; height: 90px; border-radius: 50%; display: flex;
                               align-items: center; justify-content: center; font-size: 2.5rem; font-weight: 800; margin: 0 auto; }
        .mood-bot-window { height: 200px; overflow-y: auto; background: #f1f3f4; border-radius: 10px; padding: 10px; }
        .chat-bubble-bot { background: #0f3460; color: white; padding: 8px 15px; border-radius: 18px 18px 18px 0; display: inline-block; max-width: 80%; font-size: 0.9rem; margin-bottom: 8px; }
        .chat-bubble-user { background: #dc3545; color: white; padding: 8px 15px; border-radius: 18px 18px 0 18px; display: inline-block; max-width: 80%; font-size: 0.9rem; margin-bottom: 8px; }
        .food-card { border: none; border-radius: 12px; overflow: hidden; transition: transform 0.3s; }
        .food-card:hover { transform: translateY(-3px); }
        .cart-sidebar { position: sticky; top: 80px; }
        footer { background: #1a1a2e; color: #aaa; padding: 40px 0 20px; margin-top: 80px; }
    </style>
</head>
<body>
    @include('partials.navbar')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'></script>
    @stack('scripts')
</body>
</html>
