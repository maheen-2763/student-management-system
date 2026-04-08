<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100">

<div class="flex h-screen">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white dark:bg-gray-800 shadow-lg hidden md:block">
        <div class="p-6 text-xl font-bold border-b dark:border-gray-700">
            📊 Dashboard
        </div>

        <nav class="mt-4 space-y-2 px-4">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-blue-500 hover:text-white transition">
                🏠 Dashboard
            </a>
            <a href="{{ route('students.index') }}"
               class="block px-4 py-2 rounded hover:bg-blue-500 hover:text-white transition">
                👨‍🎓 Students
            </a>

            
        </nav>
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        <header class="bg-white dark:bg-gray-800 shadow px-6 py-4 flex justify-between items-center">

            <h1 class="text-lg font-semibold">
                Welcome 👋
            </h1>

            <div class="flex items-center gap-4">

                {{-- Dark Mode Toggle --}}
                <button @click="darkMode = !darkMode"
                        class="px-3 py-1 bg-gray-200 dark:bg-gray-700 rounded">
                    🌙
                </button>

                {{-- User --}}
                <div x-data="{ open: false }" class="relative">

    {{-- Profile Button --}}
    <button @click="open = !open" 
            class="flex items-center gap-2 focus:outline-none">

        {{-- Avatar --}}
        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center">
            {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
        </div>

        {{-- Name --}}
        <span class="hidden md:block">
            {{ auth()->user()->name ?? 'Guest' }}
        </span>

        ▼
    </button>

    {{-- Dropdown --}}
    <div x-show="open" 
         @click.away="open = false"
         x-transition
         class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-50">

        {{-- Profile --}}
        <a href="#"
           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
            👤 Profile
        </a>

        {{-- Settings --}}
        <a href="#"
           class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
            ⚙️ Settings
        </a>

        {{-- Divider --}}
        <div class="border-t my-2 dark:border-gray-700"></div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-700">
        🚪 Logout
    </button>
</form>

    </div>

</div>

            </div>
        </header>

        {{-- Page Content --}}
        <main class="p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>