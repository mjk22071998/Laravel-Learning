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
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                @method('post')
                <!-- Post Title -->
                <x-input name="title" id="title" type="text" label="Post Title" value="{{ $post->title }}"/>
            
                <!-- Post Body -->
                <x-multiline-input name="body" id="body" rows="10" label="Your Post Body" minWords="100" value="{{ $post->body }}"/>
            </form>
        </div>
        <div class="col-span-4 p-4 sticky top-4">
            <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                <dt class="font-medium text-slate-900">Created at</dt>
                <dd class="text-slate-700">{{$post->created_at->format('F j, Y, h:i:s A') }}</dd>

                <dt class="font-medium text-slate-900">Last Updated at</dt>
                <dd class="text-slate-700">{{ $post->updated_at->format('F j, Y, h:i:s A') }}</dd>
            </dl>
            <div class="grid grid-cols-2 gap-2 mt-4">
                <x-button href="{{ route('post.show', $post->id)}}" size="regular" label="Cancel"
                    class="w-full text-center" />
                <form action="{{ route('post.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <x-button size="regular" label="Update" type="submit" class="w-full"
                        onclick="return confirm('Are you sure you want to Update this post?')" />
                </form>
            </div>
        </div>
    </div>
</x-public-master>