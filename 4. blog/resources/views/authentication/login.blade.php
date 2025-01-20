<x-admin-master>
    <div class="max-w-lg mx-auto p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Login</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <!-- Email -->
            <x-input name="email" id="email" type="email" label="Email" />

            <!-- Password -->
            <x-input name="password" id="password" type="password" label="Password" />

            <!-- Remember Me -->
            <div class="mb-4">
                <label for="remember" class="inline-flex items-center text-gray-700">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox text-slate-800">
                    <span class="ml-2">Remember Me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button size="regular" label="Login" type="submit" class="block mx-auto" />
            </div>

            <!-- Forgot Password Link -->
            <div class="text-center text-sm">
                <a href="{{ route('password.request') }}" class="text-slate-800 hover:underline">Forgot Your
                    Password?</a>
            </div>
        </form>
    </div>
</x-admin-master>