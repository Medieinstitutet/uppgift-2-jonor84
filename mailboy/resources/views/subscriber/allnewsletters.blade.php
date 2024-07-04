<x-app-layout>
    @if (auth()->check() && auth()->user()->hasRole('subscriber'))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('All Newsletters') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if ($activeNewsletters->isEmpty())
                            <p>{{ __("No active newsletters available.") }}</p>
                        @else
                            <ul>
                                @foreach ($activeNewsletters as $newsletter)
                                    <li>
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <strong>{{ $newsletter->name }}</strong>
                                                ({{ optional($newsletter->created_at)->format('M d, Y') ?? 'No Date Available' }})
                                            </div>
                                            <div>
                                                @php
                                                    $subscribed = auth()->user()->newsletters->contains($newsletter->id);
                                                @endphp
                                                @if ($subscribed)
                                                    <form action="{{ route('unsubscribe.newsletter', ['newsletterId' => $newsletter->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger m-1"><i class="bi bi-dash-circle"></i> Unsubscribe</button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('subscribe.newsletter', ['newsletterId' => $newsletter->id]) }}" method="POST" id="subscribeForm{{ $newsletter->id }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-light m-1"><i class="bi bi-plus-circle"></i> Subscribe Now</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
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
