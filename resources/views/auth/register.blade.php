<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ethiopian Restaurant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-red-700 to-red-900">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white rounded-lg shadow-2xl p-8">
            <div class="text-center">
                <div class="text-6xl mb-4">🇪🇹</div>
                <h2 class="text-3xl font-extrabold text-gray-900">Create Account</h2>
                <p class="mt-2 text-sm text-gray-600">Register as a new customer</p>
            </div>
            
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input id="name" name="name" type="text" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" 
                               placeholder="John Doe" value="{{ old('name') }}">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input id="email" name="email" type="email" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" 
                               placeholder="you@example.com" value="{{ old('email') }}">
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" 
                               placeholder="Minimum 6 characters">
                    </div>
                    
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" 
                               placeholder="Confirm your password">
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        @foreach($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Register
                    </button>
                </div>
                
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm text-red-600 hover:text-red-500">
                        Already have an account? Sign in here
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>