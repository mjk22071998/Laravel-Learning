<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="font-extrabold text-3xl">Subjects</h1>
                    <div>
                        <form action="{{ route('subject.store') }}" method="POST"
                            class="flex space-x-2 items-center mt-4 ">
                            @csrf
                            @method('post')
                            <x-input-label for="name" :value="__('Subject Name')" />
                            <x-text-input id="name" class="block mt-1 flex-1" placeholder="Enter subject name"
                                type="text" name="name" required autofocus
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            <x-primary-button>Create Subject</x-primary-button>
                        </form>
                    </div>
                    <div class="p-4">
                        @if (count($subjects) < 1)
                            <p class="text-gray-900">No subjects found.</p>
                        @else
                            <x-table>
                                <x-table-header-row>
                                    <th class="border border-gray-900 w-1/6">Subject ID</th>
                                    <th class="border border-gray-900 w-3/6">Subject Name</th>
                                    <th class="border border-gray-900 w-2/6">Actions</th>
                                </x-table-header-row>
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td id="subjectID" class="border border-gray-900">{{ $subject->id }}</td>
                                        <td id="subjectName" contenteditable="false" class="border border-gray-900">
                                            {{ $subject->name }}
                                        </td>
                                        <td class="border border-gray-900">
                                            <!-- Edit Button -->
                                            <x-primary-button id="editBtn">Edit</x-primary-button>

                                            <!-- Delete Button -->
                                            <form action="{{ route('subject.destroy', $subject) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <x-danger-button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this subject?')">Delete</x-danger-button>
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
    <script>
        function editSubject() {

        }
    </script>
</x-admin-panel>
