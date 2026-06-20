<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ethiopian Restaurant - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
       {
            background: linear-gradient(135deg, #dc2626, #991b1b, #f59e0b);
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .::before {
            content: "🇪🇹";
            position: absolute;
            font-size: 200px;
            opacity: 0.1;
            bottom: -50px;
            right: -50px;
        }
        . h1 {
            font-size: 56px;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
        }
        . p {
            font-size: 24px;
            animation: fadeInUp 1s ease;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @media (max-width: 768px) {
            .{
                height: 300px;
            }
            . h1 {
                font-size: 32px;
            }
            . p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Banner Section -->
    @if(!request()->is('pos*') && !request()->is('admin*') && !request()->is('login') && !request()->is('register'))
    <div class="">
        <div>
            <h1>🇪🇹 Ethiopian Restaurant</h1>
            <p>Experience the Authentic Taste of Ethiopia</p>
            <div class="mt-6 flex gap-4 justify-center">
                <div class="text-center">
                    <div class="text-3xl">🍲</div>
                    <div>Traditional Wot</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl">🫓</div>
                    <div>Fresh Injera</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl">☕</div>
                    <div>Coffee Ceremony</div>
                </div>
            </div>
            <a href="/pos" class="inline-block mt-8 bg-yellow-500 text-black px-8 py-3 rounded-lg hover:bg-yellow-400 transition font-bold">
                Order Now
            </a>
        </div>
    </div>
    @endif

    <nav class="bg-red-700 text-white p-4 sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <a href="/" class="text-xl font-bold hover:text-yellow-300">🇪🇹 Ethiopian Restaurant</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="hover:text-yellow-300">Admin</a>
                    @endif
                    <a href="/pos" class="hover:text-yellow-300">POS</a>
                @endauth
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span>Welcome, {{ auth()->user()->name }}</span>
                    <a href="/logout" class="hover:text-yellow-300">Logout</a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white p-3 text-center">{{ session('error') }}</div>
    @endif

    <main>
        @yield('content')
    </main>
    <style>
    . {
        background: linear-gradient(90deg, #078930 0%, #078930 33%, #fcdd09 33%, #fcdd09 66%, #da121a 66%, #da121a 100%);
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
    }
    ..content {
        background: rgba(0,0,0,0.6);
        padding: 40px;
        border-radius: 20px;
        backdrop-filter: blur(5px);
    }
    .h1 {
        font-size: 48px;
        font-weight: bold;
    }
    .ethiopian-pattern {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 10px;
        background: repeating-linear-gradient(45deg, #078930, #078930 20px, #fcdd09 20px, #fcdd09 40px, #da121a 40px, #da121a 60px);
    }
</style>

<div class="">
    <div class="content">
        <h1>🇪🇹 Ethiopian Restaurant</h1>
        <p class="text-xl mt-2">Taste the Rich Flavors of Ethiopia</p>
        <p class="mt-4">🍲 Doro Wot • 🥩 Tibs • 🫓 Injera • ☕ Ethiopian Coffee</p>
        <a href="/pos" class="inline-block mt-6 bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition">
            View Menu & Order
        </a>
    </div>
    <div class="ethiopian-pattern"></div>
</div>
</body>
</html>