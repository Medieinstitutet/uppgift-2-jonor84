<x-app-layout>
    @if (auth()->check() && auth()->user()->hasRole('client'))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Subscribers for Newsletter') }} {{ $newsletter->name }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if ($newsletter->subscribers->isEmpty())
                            <p>{{ __("No subscribers found for this newsletter.") }}</p>
                        @else
                            <ul>
                                @foreach ($newsletter->subscribers as $subscriber)
                                    <li>{{ $subscriber->name }} {{ $subscriber->lastname }} ({{ $subscriber->email }}) - Added: {{ $subscriber->pivot->created_at->format('M d, Y') }}</li>
                                    <hr>
                                @endforeach
                            </ul>
                        @endif
                        <div class="flex justify-between items-center mt-5 mb-1">
                            <div class="flex items-center">
                                <a href="{{ route('client.mynewsletters') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            </div>
                        </div>
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
