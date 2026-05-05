<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-lg w-full text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome to Our Platform</h1>
        <p class="text-gray-700 mb-6">
            Our platform allows <strong>Clients</strong> to place orders from <strong>Suppliers</strong>.
            The system is managed by <strong>Admins</strong>.
        </p>
        <p class="text-gray-600 mb-8">
            First, it is required to create an account. After login, access to your specific dashboard (Admin, Supplier, or Client) is strictly controlled.
        </p>
        
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="inline-block bg-gray-600 text-white px-4 py-2 rounded shadow hover:bg-gray-700 transition">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">Create Account</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
