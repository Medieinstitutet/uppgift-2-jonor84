@extends('layouts.app')

@section('content')
    <h1>Edit Newsletter</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('newsletters.update', $newsletter->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $newsletter->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $newsletter->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="active" class="form-label">Active</label>
            <select id="active" name="active" class="form-control" required>
                <option value="1" {{ $newsletter->active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$newsletter->active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Newsletter</button>
    </form>
@endsection
