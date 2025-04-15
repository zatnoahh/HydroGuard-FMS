@extends('layouts.master')
@section('content')

<div class="container">
    <h1>Relief Centers</h1>
    <a href="{{ route('reliefCenters.create') }}" class="btn btn-primary">Add Relief Center</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reliefCenters as $reliefCenter)
                <tr>
                    <td>{{ $reliefCenter->name }}</td>
                    <td>{{ $reliefCenter->location }}</td>
                    <td>{{ $reliefCenter->capacity }}</td>
                    <td>
                        <div class="btn-group dropend">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('reliefCenters.show', $reliefCenter->id) }}">Show</a></li>
                                <li><a class="dropdown-item" href="{{ route('reliefCenters.edit', $reliefCenter->id) }}">Edit</a></li>
                                <li>
                                    <form method="POST" action="{{ route('reliefCenters.destroy', $reliefCenter->id) }}" style="display: inline;">
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

