<x-admin-master>
    <div class="grid grid-cols-12 gap-4 my-6">
        <div class="col-span-12 lg:col-span-6 xl:col-span-4 2xl:col-span-3">
            <div class="text-4xl font-black">Blog</div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-4">
        @foreach ($posts as $post)
            <div class="col-span-8 my-2 p-4 bg-slate-300 rounded-md shadow-md">
                <div class="text-2xl text-bold">{{ $post->title }}</div>
                <div class="text-md text-bold">Published: {{ $post->created_at->diffForHumans() }}</div>
                <p>{{ Str::limit(strip_tags($post->body), 100, '...') }}</p>
                <x-button class="mt-2" size="small" :label="'Read more'" :href="route('blog.single',$post->slug)" />
            </div>
        @endforeach
    </div>
    <div class="p-6">
        {{ $posts->links() }}
    </div>
</x-admin-master>
