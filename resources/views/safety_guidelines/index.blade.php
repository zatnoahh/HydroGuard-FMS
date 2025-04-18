@extends('layouts.master')
@section('content')

<div class="container">
    <h1>Safety Guidelines</h1>
    <a href="{{ route('safety_guidelines.create') }}" class="btn btn-primary">Add Safety Guideline</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($safetyGuidelines as $safetyGuideline)
                <tr>
                    <td>{{ $safetyGuideline->title }}</td>
                    <td>{{ $safetyGuideline->description }}</td>
                    <td>
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('safety_guidelines.show', $safetyGuideline->id) }}">Show</a></li>
                                <li><a class="dropdown-item" href="{{ route('safety_guidelines.edit', $safetyGuideline->id) }}">Edit</a></li>
                                <li>
                                    <form method="POST" action="{{ route('safety_guidelines.destroy', $safetyGuideline->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
