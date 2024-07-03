<x-app-layout>
    @if (auth()->check() && auth()->user()->hasRole('subscriber'))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center">
                {{ __('Welcome, ') }} {{ Auth::user()->name }}
                <img src="{{ asset('hellohand.webp') }}" alt="Dashboard Icon" class="ml-2 h-6 w-6">
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in as Subscriber!") }}
                        <p>{{ __("Your role: ") }} {{ auth()->user()->roles->first()->name }}</p>

                        {{-- Subscriber-specific content --}}
                        <p>{{ __("Subscriber-specific content goes here.") }}</p>
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