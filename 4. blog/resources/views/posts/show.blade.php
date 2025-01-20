<x-public-master>
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
        <div class="col-span-8 p-4 overflow-auto">
            <div class="mx-10 p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
                <!-- Post Title -->
                <h1 class="text-3xl font-bold text-slate-800 mb-4">{{ $post->title }}</h1>
            
                <!-- Post Body -->
                <div class="text-lg text-slate-800 mb-6">
                    <p>{{ $post->body }}</p>
                </div>
            
                <!-- Post Author and Date (Optional) -->
                <div class="flex justify-between text-sm text-slate-600">
                    <span>Posted on: {{ $post->created_at->format('F j, Y, H:i:s') }}</span>
                </div>
            </div>
        </div>
        <div class="col-span-4 p-4 sticky top-4">
            <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                <dt class="font-medium text-slate-900">Created at</dt>
                <dd class="text-slate-700">{{$post->created_at->diffForHumans() }}</dd>
            
                <dt class="font-medium text-slate-900">Last Updated at</dt>
                <dd class="text-slate-700">{{ $post->updated_at->diffForHumans() }}</dd>
            </dl>
            <div class="grid grid-cols-2 gap-2 mt-4">
                <x-button href="{{ route('post.edit', $post->id)}}" size="regular" label="Edit" class="w-full text-center"/>
                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button size="regular" label="Delete" type="submit" class="w-full"
                        onclick="return confirm('Are you sure you want to delete this post?')" />
                </form>
            </div>
        </div>
    </div>
</x-public-master>
