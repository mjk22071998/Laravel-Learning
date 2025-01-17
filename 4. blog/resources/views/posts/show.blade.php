<x-public-master>

    @if (session('success'))
        <div class="bg-green-300 text-green-900 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mx-10 p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <!-- Post Title -->
        <h1 class="text-3xl font-bold text-slate-800 mb-4">{{ $post->title }}</h1>

        <!-- Post Body -->
        <div class="text-lg text-slate-800 mb-6">
            <p>{{ $post->body }}</p>
        </div>

        <!-- Post Author and Date (Optional) -->
        <div class="flex justify-between text-sm text-slate-600">
            <span>Posted on: {{ $post->created_at->format('F j, Y') }}</span>
        </div>
    </div>
</x-public-master>
