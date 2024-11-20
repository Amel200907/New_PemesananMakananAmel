<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Santap Aja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            overflow-x: hidden;
        }

        .logo-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(to bottom, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0));
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .restaurant-showcase {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .showcase-slider {
            position: absolute;
            top: 0;
            left: 0;
            width: 400%;
            height: 100%;
            display: flex;
            animation: slide 20s infinite linear;
        }

        .showcase-image {
            width: 25%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .showcase-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
        }

        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(-200%); }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #d4af37;
            box-shadow: 0 0 0 2px rgba(212, 175, 55, 0.2);
        }

        .gold-gradient {
            background: linear-gradient(135deg, #d4af37 0%, #f9d423 100%);
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="animate-fade-in">
    <!-- Logo and Brand Section -->
    <div class="logo-container">
        <img src="img/logo.png" alt="Santap Aja Logo" class="h-16 w-auto">
        <div class="text-white">
            <h1 class="font-playfair text-2xl font-bold">Santap Aja</h1>
            <p class="text-sm text-gray-300">Premium Dining Experience</p>
        </div>
    </div>

    <div class="container max-w-7xl mx-auto relative">
        <div class="glass-card rounded-3xl overflow-hidden flex flex-col md:flex-row">
            <!-- Left Side - Restaurant Showcase -->
            <div class="w-full md:w-7/12 relative min-h-[600px]">
                <div class="restaurant-showcase">
                    <div class="showcase-slider">
                        <div class="showcase-image">
                            <img src="img/RestaurantInterior.jpg" alt="Restaurant Interior" class="w-full h-full object-cover">
                        </div>
                        <div class="showcase-image">
                            <img src="img/signature-dish.webp" alt="Signature Dish" class="w-full h-full object-cover">
                        </div>
                        <div class="showcase-image">
                            <img src="img/lllll.jpg" alt="Dining Atmosphere" class="w-full h-full object-cover">
                        </div>
                        <div class="showcase-image">
                            <img src="img/images.jpeg" alt="Chef Special" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 p-8 text-white z-10 bg-gradient-to-t from-black to-transparent">
                    <h2 class="font-playfair text-3xl font-bold mb-2">Welcome to Excellence</h2>
                    <p class="text-gray-200">Experience the finest culinary journey</p>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full md:w-5/12 p-12 flex items-center bg-[rgba(0,0,0,0.3)]">
                <div class="w-full max-w-md mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="font-playfair text-3xl font-bold text-white mb-3">Member Access</h2>
                        <p class="text-gray-300">Sign in to your exclusive account</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                                <input id="email" type="email" name="email"
                                    class="input-field w-full px-4 py-3.5 rounded-xl text-white placeholder-gray-400"
                                    placeholder="Enter your email"
                                    required autofocus>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                                <input id="password" type="password" name="password"
                                    class="input-field w-full px-4 py-3.5 rounded-xl text-white placeholder-gray-400"
                                    placeholder="Enter your password"
                                    required>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="h-4 w-4 text-yellow-500 border-gray-600 rounded focus:ring-yellow-500 bg-gray-700">
                                <label for="remember_me" class="ml-2 text-sm text-gray-300">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" 
                                   class="text-sm text-gray-300 hover:text-yellow-400 transition-colors">
                                    Forgot password?
                                </a>
                            @endif
                        </div>

                        <button type="submit"
                            class="gold-gradient hover-scale w-full text-gray-900 font-semibold py-4 px-6 rounded-xl mt-8 shadow-lg">
                            Sign In
                        </button>
                    </form>

                    @if (Route::has('register'))
                        <p class="text-center mt-8 text-gray-300">
                            New to Santap Aja? 
                            <a href="{{ route('register') }}" 
                               class="font-medium text-yellow-400 hover:text-yellow-300 transition-colors">
                                Create Account
                            </a>
                        </p>
                    @endif

                    <div class="mt-8 pt-8 border-t border-gray-700">
                        <p class="text-center text-sm text-gray-400">
                            By signing in, you agree to our Terms of Service and Privacy Policy
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>