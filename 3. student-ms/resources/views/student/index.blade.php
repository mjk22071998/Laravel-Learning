<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <span class="flex justify-between items-center">
                        <h1 class="text-3xl font-bold text-gray-900">Students</h1>
                        <a href="{{ route('student.create') }}">
                            <x-primary-button type="button">New Student</x-primary-button>
                        </a>
                    </span>
                    <div class="p-4">
                        @if (count($students) < 1)
                            <p class="text-gray-900">No students found.</p>
                        @else
                            <x-table>
                                <x-table-header-row>
                                    <th class="border border-gray-900">Student ID</th>
                                    <th class="border border-gray-900">Student Name</th>
                                    <th class="border border-gray-900">Student Email</th>
                                </x-table-header-row>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="border border-gray-900">{{ $student->user->name }}</td>
                                        <td class="border border-gray-900">{{ $student->user->email }}</td>
                                        <td class="border border-gray-900">{{ $student->id }}</td>
                                    </tr>
                                @endforeach
                            </x-table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-panel>
