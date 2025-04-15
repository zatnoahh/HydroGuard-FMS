@extends('layouts.master')
@section('content')

<div class="container">
    <h1>Sensor Detail</h1>
    <div class="card">
        <div class="card-header">
            <h4>Sungai Ramal</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Water Level: {{ $distance->value }} cm</h5><br>
            <p class="card-text">Recorded Date: {{ $distance->created_at->format('d.m.Y') }}</p>
            <p class="card-text">Recorded Time: {{ $distance->created_at->format('H:i:s') }}</p>
            <!-- <p class="card-text">Status: Normal</p> -->
            <a href="{{ route('distance.edit', $distance->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('distance.destroy', $distance->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection