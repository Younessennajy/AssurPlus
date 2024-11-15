<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="w-8 h-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-gray-900">Product</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Resources</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Features</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Pricing</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Demo</a>
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition duration-200">Login</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition duration-200">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Left Column -->
            <div>
                <h1 class="text-5xl font-bold mb-6">
                    Provide excellent<br>
                    <span class="text-orange-500">customer</span> service.
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Answer more tickets with<br>
                    all-in-one help desk software.
                </p>
                <div class="space-y-3 mb-8">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>No setup fee</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Customer service 24/7</span>
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Cancel any time</span>
                    </div>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" class="bg-orange-500 text-white px-8 py-3 rounded-md hover:bg-orange-600 transition duration-200">
                        Get Started | 14 days free
                    </a>
                    <button class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"></path>
                        </svg>
                        See it in Action
                    </button>
                </div>
                <div class="mt-12">
                    <p class="text-sm text-gray-600 mb-4">Used by</p>
                    <div class="flex gap-8 items-center">
                        <span class="text-gray-400 font-serif text-xl">Forbes</span>
                        <span class="text-gray-400">AIRBUS</span>
                        <span class="text-gray-400">NASCAR</span>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="relative">
                <!-- Chat Interface Mockup -->
                <div class="bg-blue-100 rounded-2xl p-8">
                    <div class="bg-white rounded-lg p-4 mb-4 shadow-sm">
                        <div class="flex gap-3 items-start">
                            <div class="w-8 h-8 bg-blue-500 rounded-full"></div>
                            <div>
                                <p class="text-sm text-gray-600">Hello, I'm John, how may I help you?</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-orange-500 text-white rounded-lg p-4 mb-4 ml-12 shadow-sm">
                        <p class="text-sm">I'd like to check my order status.</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <div class="flex gap-3 items-start">
                            <div class="w-8 h-8 bg-blue-500 rounded-full"></div>
                            <div>
                                <p class="text-sm text-gray-600">No problem, please provide me with your order ID.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </footer>
</body>
</html>