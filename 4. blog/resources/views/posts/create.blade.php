<x-public-master>
    <div class="max-w-2xl mx-auto p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Contact Us</h2>

        <form action="#" method="POST">
            @csrf
            @method('post')
            <!-- Name -->
            <x-input name="title" id="title" type="text" label="Post Title" />

            <!-- Message -->
            <x-multiline-input name="body" id="body" rows="10" label="Your post Body" />

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button size="regular" label="Create Post" type="submit" extraClass="mx-auto" />
            </div>
        </form>
    </div>
</x-public-master>
