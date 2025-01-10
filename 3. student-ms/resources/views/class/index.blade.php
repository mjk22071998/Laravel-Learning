<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="font-extrabold text-3xl">Subjects</h1>
                    <div>
                        <form action="{{ route('classs.store') }}" method="POST"
                            class="flex space-x-2 items-center mt-4 ">
                            @csrf
                            @method('post')
                            <x-input-label for="name" :value="__('Class Name')" />
                            <x-text-input id="name" class="block mt-1 flex-1" placeholder="Enter Class name"
                                type="text" name="name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <x-primary-button>Create Class</x-primary-button>
                        </form>
                    </div>
                    <div class="p-4">
                        @if (count($classes) < 1)
                            <p class="text-gray-900">No classes found.</p>
                        @else
                            <x-table>
                                <x-table-header-row>
                                    <th class="border border-gray-900 w-1/6">class ID</th>
                                    <th class="border border-gray-900 w-3/6">class Name</th>
                                    <th class="border border-gray-900 w-2/6">Actions</th>
                                </x-table-header-row>
                                @foreach ($classes as $class)
                                    <tr>
                                        <td id="classID" class="border border-gray-900">{{ $classs->id }}</td>
                                        <td id="className" contenteditable="false" class="border border-gray-900"
                                            data-id="{{ $classs->id }}" ondblclick="makeEditable(this)"
                                            onblur="saveChanges(this, 'classs')" onkeypress="handleEnter(event, this, 'classs')">
                                            {{ $classs->name }}
                                        </td>
                                        <td class="border border-gray-900">
                                            <!-- Edit Button -->
                                            <x-primary-button id="editBtn">Edit</x-primary-button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('classs.destroy', $classs) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this class?')">Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="toast-container"></div>
</x-admin-panel>
