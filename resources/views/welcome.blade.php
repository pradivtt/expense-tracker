<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600">
                ExpenseTracker
            </h1>

            <div class="space-x-4">
                @auth
                <a href="{{ route('dashboard') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-indigo-600">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Sign Up
                </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-24 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                Track Your <span class="text-indigo-600">Expenses</span><br>
                Smarter & Easier
            </h2>

            <p class="text-gray-600 mb-8">
                Manage your daily expenses, view monthly reports,
                and understand your spending habits with clear charts.
            </p>

            <div class="space-x-4">
                <a href="{{ route('register') }}"
                    class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg text-lg hover:bg-indigo-700">
                    Get Started
                </a>

                <a href="{{ route('login') }}"
                    class="inline-block px-6 py-3 border rounded-lg text-lg hover:bg-gray-100">
                    Login
                </a>
            </div>
        </div>

        <!-- Illustration -->
        <div class="hidden md:flex justify-center">
            <div class="bg-indigo-100 rounded-2xl p-10 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 text-indigo-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8c-1.657 0-3 1.343-3 3v4a3 3 0 006 0v-4c0-1.657-1.343-3-3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M5 8h14M5 16h14" />
                </svg>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-center mb-12">
                Why Use ExpenseTracker?
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl shadow">
                    <h4 class="text-lg font-semibold mb-2">CRUD Management</h4>
                    <p class="text-gray-600">
                        Create, update, and delete your expense data easily.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl shadow">
                    <h4 class="text-lg font-semibold mb-2">Charts & Reports</h4>
                    <p class="text-gray-600">
                        Visualize expenses with monthly and yearly charts.
                    </p>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl shadow">
                    <h4 class="text-lg font-semibold mb-2">Secure Login</h4>
                    <p class="text-gray-600">
                        Each user has their own private expense data.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>
                © {{ date('Y') }} ExpenseTracker. Built with Laravel & Tailwind CSS.
            </p>
        </div>
    </footer>

</body>

</html>