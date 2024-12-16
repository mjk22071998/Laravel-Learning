<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <span class="flex justify-between items-center">
                        <h1 class="text-3xl font-bold text-gray-900">Students</h1>
                        <a href="{{ route('student.create') }}" class="p-2 hover:bg-gray-200">
                            <button type="button">New Student</button>
                        </a>
                    </span>
                    <div class="p-4">
                        @if (count($students) < 1)
                            <p class="text-gray-900">No students found.</p>
                        @else
                            <table>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Student Email</th>
                                </tr>
                                @foreach ($studets as $student)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-panel>
