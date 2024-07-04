<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Newsletter') }}
        </h2>
    </x-slot>

    @if (auth()->check() && auth()->user()->hasRole('client'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('client.store-newsletter') }}" method="POST">
                    @csrf

                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3"
                                    class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                                @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="active" class="block text-sm font-medium text-gray-700">Active</label>
                                <select name="active" id="active"
                                    class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('active') === '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('active')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <a href="{{ route('client.mynewsletters') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            </div>

                            <div class="flex items-center">
                                <button type="submit"
                                    class="btn btn-success">
                                    <i class="bi bi-plus-circle"></i> Create Newsletter
                                </button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("No access.") }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
