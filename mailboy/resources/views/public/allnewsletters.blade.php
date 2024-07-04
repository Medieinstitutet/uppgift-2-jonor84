<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Newsletters') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($newsletters->isEmpty())
                        <p>No newsletters available.</p>
                    @else
                        <ul>
                        @foreach ($newsletters as $newsletter)
                            <li class="py-3 flex justify-between items-center">
                                <h2>{{ $newsletter->name }}</h2>
                                <span>{{ $newsletter->created_at ? $newsletter->created_at->format('M d, Y') : 'No Date Available' }}</span>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
