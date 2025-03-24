@extends('layouts.app')
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
                        <a href="{{ route('reliefCenters.show', $reliefCenter->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('reliefCenters.edit', $reliefCenter->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('reliefCenters.destroy', $reliefCenter->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

