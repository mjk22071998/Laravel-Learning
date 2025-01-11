<x-admin-panel>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <span class="flex justify-between items-center">
                        <h1 class="text-3xl font-bold text-gray-900">Add New Students</h1>
                        <a href="{{ route('student.index') }}">
                            <x-primary-button type="button">All Students</x-primary-button>
                        </a>
                    </span>
                    <form action="{{ route('student.store') }}" method="POST" class="mt-4">
                        @csrf
                        @method('post')
                        
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Class Dropdown -->
                        <div class="mt-4">
                            <x-input-label for="class" :value="__('Class')" />
                            <select id="class" name="class_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="" disabled selected>Select a Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('class_id')" class="mt-2" />
                        </div>

                        <!-- Subjects Multi-Select -->
                        <div class="mt-4">
                            <x-input-label for="subjects" :value="__('Subjects')" />
                            <select id="subjects" name="subjects[]" multiple
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('subjects')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                Create Student
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-panel>
