<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ethiopian Restaurant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-red-700 to-red-900 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="text-6xl mb-4">🇪🇹</div>
            <h1 class="text-3xl font-bold text-gray-800">Create Account</h1>
            <p class="text-gray-600 mt-2">Register as a new customer</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                <input type="text" name="name" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input type="email" name="email" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" required>
            </div>
            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition">
                Register
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="/login" class="text-red-600 hover:text-red-700">Already have an account? Sign in</a>
        </div>
    </div>
</body>
</html>