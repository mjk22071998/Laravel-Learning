<x-master>
    @if (session('error'))
        <div class="bg-red-300 text-red-800 m-10 p-4 rounded">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="bg-green-300 text-green-900 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="max-w-lg mx-auto p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Register</h2>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Name -->
            <x-input name="name" id="name" type="text" label="Full Name" />

            <!-- Email -->
            <x-input name="email" id="email" type="email" label="Email" />

            <!-- Password -->
            <x-input name="password" id="password" type="password" label="Password" />

            <!-- Confirm Password -->
            <x-input name="password_confirmation" id="password_confirmation" type="password" label="Confirm Password" />

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button size="regular" label="Register" type="submit" class="block mx-auto" />
            </div>
        </form>
    </div>
</x-master>