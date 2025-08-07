<!DOCTYPE html>
<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <title>Login</title>
    </head>
    <body class="font-poppins bg-slate-50 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md border border-border py-8 shadow-xl rounded-2xl">
            <!-- Header with back arrow and title -->
            <div class="flex items-center mb-0 px-6">
            <a href="{{ url('/') }}" class="p-2 text-slate-600 hover:text-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-slate-800">Login</h2>
            </div>

            <!-- Login Form -->
            <div class="bg-white px-8 pt-3">
                @if(session('error'))
                    <div class="mb-6 px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-600 text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Username Field -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">
                            Username
                        </label>
                        <input
                            type="text"
                            name="username"
                            id="username"
                            required
                            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors placeholder-slate-400 text-slate-900"
                            placeholder="Enter your username"
                        >
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            class="w-full px-4 py-3 border border-border rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors placeholder-slate-400 text-slate-900"
                            placeholder="Enter your password"
                        >
                    </div>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        class="w-full bg-slate-700 hover:bg-slate-800 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2"
                    >
                        Login
                    </button>
                </form>

                <!-- Additional Links -->
                <div class="mt-6 text-center">
                    <a href="#" class="text-sm text-slate-600 hover:text-slate-800 transition-colors">
                        lupa password? hubungi admin
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
