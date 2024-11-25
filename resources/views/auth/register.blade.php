<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Santap Aja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-gradient-to-br {
            from: #eead8a;
            to: #c7996e;
        }

        .text-gray-800 {
            color: #422e1a;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-6">
    <div class="container max-w-screen-lg mx-auto">
        <div class="bg-white rounded-2xl shadow-xl flex flex-col md:flex-row">
            <!-- Left Side - Illustration -->
            <div class="w-full md:w-1/2 p-12 flex items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600 rounded-l-2xl">
                <div class="isometric-illustration building">
                    <svg class="w-full max-w-md" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- Your building illustration SVG here -->
                    </svg>
                </div>
            </div>

            <!-- Right Side - Register Form -->
            <div class="w-full md:w-1/2 p-12">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Create an Account</h2>
                        <p class="text-gray-500">Fill in the details below to create your account</p>
                    </div>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input id="name" type="text" name="name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input id="email" type="email" name="email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input id="password" type="password" name="password"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                                required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200">
                            Register
                        </button>
                    </form>

                    <p class="text-center mt-8 text-sm text-gray-600">
                        Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
