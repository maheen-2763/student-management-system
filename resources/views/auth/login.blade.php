<x-guest-layout>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- Logo / Title --}}
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">🎓 Student App</h2>
            <p class="text-gray-500 text-sm">Login to your account</p>
        </div>

        {{-- Session Status --}}
        <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required autofocus
                >
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500" />
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password"
                    placeholder="Enter your password"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required
                >
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500" />
            </div>

            {{-- Remember + Forgot --}}
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember" class="rounded">
                    Remember me
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
                        Forgot?
                    </a>
                @endif
            </div>

            {{-- Login Button --}}
            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition shadow">
                Login
            </button>

        </form>

        {{-- Divider --}}
        <div class="my-6 border-t"></div>

        {{-- Register Link --}}
        <p class="text-center text-sm text-gray-600">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">
                Register
            </a>
        </p>

    </div>

</div>
</x-guest-layout>