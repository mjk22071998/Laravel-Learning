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

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-8 p-4 overflow-auto">
            <form id="postForm" action="{{ route('post.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Post Title -->
                <x-input name="title" id="title" type="text" label="Post Title" value="{{ $post->title }}" />

                <!-- Post Body -->
                <x-ck-editor initialContent="{{$post->body}}" name="body" id="body" label="Your Post Body" />
                {{-- <x-multiline-input name="body" id="body" rows="10" label="Your Post Body" minWords="100"
                    value="{{ $post->body }}" /> --}}

                {{-- Categories --}}
                <select name="cat_id" id="cat_id"
                    class="block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required>
                    <option value="" disabled>Choose a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $post->cat_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Tags --}}
                <select id="tags" name="tags[]" class="js-example-basic-multiple" multiple="multiple" required>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-span-4 p-4 sticky top-4">
            <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                <dt class="font-medium text-slate-900">URL</dt>
                <dd class="text-slate-700">{{ url("blog/$post->slug")}}</dd>

                <dt class="font-medium text-slate-900">Category</dt>
                <dd class="text-slate-700">{{ $post->category->name ?? 'No Category Assigned' }}</dd>

                <dt class="font-medium text-slate-900">Created By</dt>
                <dd class="text-slate-700">{{ $post->user->name ?? 'No Category Assigned' }}</dd>

                <dt class="font-medium text-slate-900">Created at</dt>
                <dd class="text-slate-700">{{$post->created_at->diffForHumans() }}</dd>

                <dt class="font-medium text-slate-900">Last Updated at</dt>
                <dd class="text-slate-700">{{ $post->updated_at->diffForHumans() }}</dd>
            </dl>
            <div class="grid grid-cols-2 gap-2 mt-4">
                <x-button href="{{ route('post.show', $post->id)}}" size="regular" label="Cancel"
                    class="w-full text-center" />
                <x-button id="submitForm" size="regular" label="Update" class="w-full" />
            </div>
        </div>
    </div>
</x-master>