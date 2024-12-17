<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <x-table>
                        <x-table-header-row>
                            <th class="border border-gray-900">
                                Entity
                            </th>
                            <th class="border border-gray-900">
                                Quantity
                            </th>
                        </x-table-header-row>
                        <tr>
                            <td class="border border-gray-900">
                                Students
                            </td>
                            <td class="border border-gray-900">
                                {{ $studentCount }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-900">
                                Classes
                            </td>
                            <td class="border border-gray-900">
                                {{ $classCount }}
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-900">
                                Subjects
                            </td>
                            <td class="border border-gray-900">
                                {{ $subjectCount }}
                            </td>
                        </tr>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-admin-panel>
