<x-admin-master title="All Posts">
    @if (session('error'))
        <div class="bg-red-300 text-red-800 m-10 p-4 rounded">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="bg-green-300 text-green-900 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-10">
            <h2 class="text-3xl font-bold">All Posts</h2>
        </div>
        <div class="col-span-2">
            <x-button href="{{ route('post.create')}}" 
                size="regular" label="Create New Post" class="w-full text-center" />
        </div>
    </div>
    <div class="m-4 p-4">
        @if($posts->isEmpty())
            <p>No posts available</p>
        @else
            <table class="co table-auto border-collapse border border-slate-400 w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-300 px-4 py-2">#</th>
                        <th class="border border-slate-300 px-4 py-2">title</th>
                        <th class="border border-slate-300 px-4 py-2">body</th>
                        <th class="border border-slate-300 px-4 py-2">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td class="border border-slate-300 px-4 py-2">{{ $post->id }}</td>
                            <td class="border border-slate-300 px-4 py-2">{{ $post->title }}</td>
                            <td class="border border-slate-300 px-4 py-2">{{ Str::limit($post->body, 50) }}</td>
                            <td class="border border-slate-300 px-4 py-2">{{ $post->created_at->diffForHumans() }}</td>
                            <td class="border border-slate-300 px-4 py-2">
                                <x-button href="{{ route('post.show', $post->id) }}" 
                                    size="regular" label="View Full Post" class="m-4 text-center"/>
                            </td>
                        </tr>
                    @endforeach
            </table>
        @endif
    </div>
    <div class="p-6">
        {{ $posts->links() }}
    </div>
</x-public-master>
