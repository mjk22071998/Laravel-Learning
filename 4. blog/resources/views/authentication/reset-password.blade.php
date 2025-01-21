<x-master>
    <div class="max-w-lg mx-auto p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Reset Password</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            <!-- Email -->
            <x-input name="email" id="email" type="email" label="Email" />

            <!-- Password -->
            <x-input name="password" id="password" type="password" label="New Password" />

            <!-- Confirm Password -->
            <x-input name="password_confirmation" id="password_confirmation" type="password"
                label="Confirm New Password" />

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button size="regular" label="Reset Password" type="submit" class="block mx-auto" />
            </div>
        </form>
    </div>
</x-master>