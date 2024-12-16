<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="w-full text-center border border-gray-900">
                        <tr class="bg-gray-900 text-gray-100 border-b border-gray-900">
                            <th class="border-r border-gray-900">
                                Entity
                            </th>
                            <th>
                                Quantity
                            </th>
                        </tr>
                        <tr>
                            <td class="border-r border-gray-900">
                                Students
                            </td>
                            <td>
                                {{ $studentCount }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border-r border-gray-900">
                                Classes
                            </td>
                            <td>
                                {{ $classCount }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border-r border-gray-900">
                                Subjects
                            </td>
                            <td>
                                {{ $subjectCount }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-panel>
