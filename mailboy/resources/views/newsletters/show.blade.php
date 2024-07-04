@extends('layouts.app')

@section('content')
    <h1>Newsletter Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $newsletter->name }}</p>
        <p><strong>Description:</strong> {{ $newsletter->description ?: 'N/A' }}</p>
        <p><strong>Status:</strong> {{ $newsletter->active ? 'Active' : 'Inactive' }}</p>
        <p><strong>Added By:</strong> {{ $newsletter->user->name }}</p>
    </div>
    <a href="{{ route('newsletters.index') }}" class="btn btn-primary">Back to List</a>
@endsection
