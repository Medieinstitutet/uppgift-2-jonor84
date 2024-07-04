@extends('layouts.app')

@section('content')
    <h1>Newsletters</h1>
    
    <a href="{{ route('newsletters.create') }}" class="btn btn-primary">Create New Newsletter</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Active</th>
                <th>Added By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($newsletters as $newsletter)
                <tr>
                    <td>{{ $newsletter->id }}</td>
                    <td>{{ $newsletter->name }}</td>
                    <td>{{ $newsletter->description }}</td>
                    <td>{{ $newsletter->active ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $newsletter->user->name }}</td>
                    <td>
                        <a href="{{ route('newsletters.show', $newsletter->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('newsletters.edit', $newsletter->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('newsletters.destroy', $newsletter->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
