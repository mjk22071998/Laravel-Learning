<x-admin-master>
    <div class="max-w-lg mx-auto p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Forgot Your Password?</h2>

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <!-- Email -->
            <x-input name="email" id="email" type="email" label="Enter Your Email" />

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button size="regular" label="Send Password Reset Link" type="submit" class="block mx-auto" />
            </div>
        </form>
    </div>
</x-admin-master>