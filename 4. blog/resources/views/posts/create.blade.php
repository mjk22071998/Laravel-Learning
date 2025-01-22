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
    <div class="max-w-2xl mx-auto p-6 bg-slate-200 rounded-lg shadow-lg mb-6">
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Contact Us</h2>

        <form id="postForm" action="{{ route('post.store') }}" method="POST">
            @csrf
            @method('post')
            <!-- Post Title -->
            <x-input name="title" id="title" type="text" label="Post Title" />

            <!-- Post Body -->
            {{-- <x-multiline-input name="body" id="body" rows="10" label="Your Post Body" minWords="100" /> --}}

            <x-ck-editor name="body" id="body" label="Your Post Body"/>

            <!-- Category Selection -->
            <div class="mb-4">
                <label for="cat_id" class="block font-medium text-slate-800 mb-2">Select Category</label>
                <select name="cat_id" id="cat_id"
                    class="block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required>
                    <option value="" disabled selected>Choose a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            {{-- Multiselect input using select2 --}}
            <div class="mb-4">
                <label for="tags" class="block font-medium text-slate-800 mb-2">Select Tags (max 5)</label>
                <select id="tags" name="tags[]" multiple class="js-example-basic-multiple w-full border-gray-300 rounded-lg">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <p id="tag-limit-message" class="text-sm text-red-500 hidden mt-1">You can select a maximum of 5 tags.</p>
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <x-button id="submitForm" size="regular" label="Create Post" type="submit" class="block mx-auto" />
            </div>
        </form>
    </div>
</x-master>
