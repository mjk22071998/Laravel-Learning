<x-master>
    @if (session('error'))
        <div class="bg-red-300 text-red-900 m-10 p-4 rounded">
            {{ session('error') }}
        </div>
    @elseif (session('success'))
        <div class="bg-green-300 text-green-900 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="font-extrabold text-3xl">Categories</h1>
                    <div class="w-full">
                        <form action="{{ route('category.store') }}" method="POST" class="flex space-x-2 items-center mt-4">
                            @csrf
                            @method('POST')
                        
                            <!-- Using the Custom Input Component -->
                            <x-inline-input id="name" name="name" label="Category Name" placeholder="Enter Category name" required autofocus
                                autocomplete="name"/>
                        
                            <!-- Error Display -->
                            @if ($errors->has('name'))
                                <p class="text-red-500 text-sm mt-2">{{ $errors->first('name') }}</p>
                            @endif
                        
                            <!-- Using the Custom Button Component -->
                            <x-button label="Create Category" type="submit" size="regular" />
                        </form>
                    </div>
                    <div class="p-4">
                        @if (count($categories) < 1)
                            <p class="text-slate-900">No categories found.</p>
                        @else
                            <table class="w-full">
                                <thead>
                                    <th class="border border-slate-900 w-1/6">Category ID</th>
                                    <th class="border border-slate-900 w-3/6">Category Name</th>
                                    <th class="border border-slate-900 w-2/6">Actions</th>
                                </thead>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td id="categoryID" class="border border-slate-900">{{ $category->id }}</td>
                                        <td id="categoryName" contenteditable="false" class="border border-slate-900"
                                            data-id="{{ $category->id }}" ondblclick="makeEditable(this)"
                                            onblur="saveChanges(this, 'category')"
                                            onkeypress="handleEnter(event, this, 'category')">
                                            {{ $category->name }}
                                        </td>
                                        <td class="border border-slate-900">
                                            <!-- Delete Button -->
                                            <form action="{{ route('category.destroy', $category) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <x-button type="submit" label="Delete" size="regular" class="mx-auto"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"/>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="toast-container"></div>
</x-master>