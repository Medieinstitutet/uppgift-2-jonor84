<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Newsletters') }}
            </h2>
            <a href="{{ route('client.create-newsletter') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> {{ __('Add Newsletter') }}
            </a>
        </div>
    </x-slot>

    @if (auth()->check() && auth()->user()->hasRole('client'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        @if ($clientNewsletters->isEmpty())
                            <p>{{ __("You haven't created any newsletters yet.") }}</p>
                        @else
                            <ul>
                                @foreach ($clientNewsletters as $newsletter)
                                    <li class="py-3 flex justify-between items-center">
                                        <div>
                                            <h2>{{ $newsletter->id }}: {{ $newsletter->name }} ({{ optional($newsletter->created_at)->format('M d, Y') ?? 'No Date Available' }}) 
                                                @if ($newsletter->active == 1)
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                @else
                                                    <i class="bi bi-x-circle-fill text-dark"></i>
                                                @endif
                                            </h2>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('client.mysubscribers', ['newsletterId' => $newsletter->id]) }}" class="btn btn-light">
                                                <i class="bi bi-people"></i> Subscribers
                                            </a>
                                            <a href="{{ route('client.edit-newsletter', $newsletter->id) }}" class="btn btn-light text-primary ml-2 mr-2">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('client.destroy-newsletter', $newsletter->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-light text-danger">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                    <hr>
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
