<x-admin-master>
    @if (session('error'))
        <div class="bg-red-300 text-red-800 m-10 p-4 rounded">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="bg-green-300 text-green-900 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif
    {{-- Welcome Jumbotron --}}
    <div class="p-5 mx-10 mb-4 bg-slate-200 rounded-lg">
        <div class="container  py-5">
            <h1 class="text-4xl font-bold mb-4">Welcome to the blog</h1>
            <p class="text-lg text-slate-800 mb-6">
                This is the developer's first major project in their Laravel learning journey. Dive into a world of
                fresh insights, engaging stories, and thought-provoking ideas. The developer is excited to share
                valuable content that sparks curiosity and inspires you to explore more with every post!
            </p>
        </div>
    </div>
    {{-- Main Content --}}
    <div class="grid grid-cols-12 gap-4">
        {{-- Latest posts --}}
        <div class="col-span-8 p-4">
            <h2 class="text-2xl font-bold">Latest Posts</h2>

            @foreach ($posts as $post)
                <x-post title="{{ $post->title }}" 
                    content="{{ Str::limit(strip_tags($post->body), 100, '...') }}"
                    buttonLabel="Read Full Article" class="mt-2" :href="route('blog.single', $post->slug)"/>
            @endforeach



        </div>
        {{-- Sidebar --}}
        <div class="col-span-4 p-4">
            <h2 class="text-2xl font-bold">Sidebar</h2>
        </div>
    </div>

</x-admin-master>
